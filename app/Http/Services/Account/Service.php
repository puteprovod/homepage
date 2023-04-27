<?php

namespace App\Http\Services\Account;


use App\Http\Resources\Account\AccountResource;
use App\Models\Account;
use App\Models\AccountHistory;
use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Service
{
    public function getActualAccountsInfo()
    {
        $role = Auth::user() ? Auth::user()['role'] : '';
        if ($role != 'admin') {
        Cache::tags('accounts')->flush();
        }
        return Cache::tags('accounts')->remember('json', now()->addMinutes(1440), function () {
            app()->make(\App\Http\Services\Currency\Service::class);
            $this->calculateCosts();
            $accounts = DB::table('accounts')
                ->join('categories', 'accounts.category_id', '=', 'categories.id')
                ->join('currencies', 'accounts.currency_id', '=', 'currencies.id')
                ->select('accounts.*', 'categories.title as category_title', 'currencies.title as currency_title')
                ->orderBy('categories.title')
                ->get();
            $accounts = AccountResource::collection($accounts)->resolve();
            $historyAll = AccountHistory::all();
            $historyDatesCollection = $historyAll->pluck('shot_date')->unique()->sortDesc()->values();

            $history = $historyDates = [];
            if ($historyDatesCollection) {
                $history = $historyDatesCollection->map(function ($item) use ($historyAll) {
                    return $historyAll->where('shot_date', $item);
                })->toArray();
                $historyDates = $historyDatesCollection->map(function ($item) {
                    return Carbon::parse($item)->format('d.m.Y');
                })->toArray();
            }
            $chartValues = $this->getChartValues();
            return [
                'accounts' => $accounts,
                'history' => $history,
                'historyDates' => $historyDates,
                'chartValues' => $chartValues
            ];
        });
    }

    public function calculateCosts(): void
    {
        $accounts = Account::join('currencies', 'accounts.currency_id', '=', 'currencies.id')
            ->select('accounts.*', 'currencies.exchange_rate as exchange_rate', 'currencies.source as source')
            ->get();
        $usd = Currency::where('title', 'USD')->first()->exchange_rate;
        foreach ($accounts as $account) {
            if ($account->source == 'cbr' or $account->source == 'rub') {
                $account->update(['cost' => ceil($account->value * $account->exchange_rate)]);
            } else {
                $account->update(['cost' => ceil($account->value * $account->exchange_rate * $usd)]);
            }
        }
    }

    public function calculateCost($id): float
    {
        $account = Account::find($id);
        $currency = Currency::find($account->currency_id);
        if ($currency->source == 'cbr' or $currency->source == 'rub') {
            return ceil($account->value * $currency->exchange_rate);
        } else {
            $usd = Currency::find(11)->exchange_rate;
            return ceil($account->value * $currency->exchange_rate * $usd);
        }

    }

    public function getChartValues(): array
    {
        $currencySums = Account::join('currencies', 'accounts.currency_id', '=', 'currencies.id')
            ->select('currencies.title as currency_title')
            ->groupBy('currency_id')
            ->selectRaw('sum(cost) as sum, currencies.title as currency_title')
            ->pluck('sum', 'currency_title');
        $finalSum = $currencySums->sum();
        $topSums = $currencySums->sortDesc()->take(4);
        $percentages = ($finalSum !== 0) ? $topSums->values()->map(callback: function ($item) use ($finalSum) {
            return $item / $finalSum * 100;
        }) : [];
        return [
            'labels' => $topSums->put('Other', $finalSum - $topSums->sum())->keys()->all(),
            'datasets' => $topSums->values()->all(),
            'percentages' => $percentages->push(100 - $percentages->sum())->all(),
        ];
    }
}
