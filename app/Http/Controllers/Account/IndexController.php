<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\AccountResource;
use App\Models\Account;
use App\Models\AccountHistory;
use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
        Account::calculateCosts();

        $accounts = Account::all();
        $accounts = collect(AccountResource::collection($accounts)
            ->resolve())->sortBy('category_title')->values()->toArray();
        $saveDate = Carbon::now()->format('d.m.Y');

        $historyDatesCollection = AccountHistory::all()
            ->pluck('shot_date')->unique()->sortDesc()->values();

        $history = $historyDates = [];
        if ($historyDatesCollection) {
            $history = $historyDatesCollection->map(function ($item) {
                return AccountHistory::all()->where('shot_date', $item);
            })->toArray();
            $historyDates = $historyDatesCollection->map(function ($item) {
                return Carbon::parse($item)->format('d.m.Y');
            })->toArray();
        }
        $chartValues = Account::getChartValues();

        $role = Auth::user() ? Auth::user()['role'] : '';
        if ($role != 'admin') {
            $chartValues = $history = $historyDates = '';
            $i = 0;
            foreach ($accounts as $account)
                if ($i++ % 2 == 0)
                    unset ($accounts[$i]);
        }

        return inertia('Account/Index', compact('accounts', 'saveDate', 'history', 'historyDates', 'chartValues'));  // VIEW
    }
}
