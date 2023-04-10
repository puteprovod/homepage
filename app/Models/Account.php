<?php

namespace App\Models;

use App\Models\Trades\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Account extends Model
{
    protected $table = 'accounts';
    protected $guarded = [];

    use HasFactory;
    use Filterable;

    public static function calculateCosts()
    {
        $accounts = Account::all();
        $currencies = Currency::all();
        $usd = $currencies->firstWhere('id', 11)->exchange_rate;
        foreach ($accounts as $account) {
            $currency = $currencies->firstWhere('id', $account->currency_id);
            if ($currency->source == 'cbr' or $currency->source == 'rub') {
                $account->update(['cost' => ceil($account->value * $currency->exchange_rate)]);
            } else {
                $account->update(['cost' => ceil($account->value * $currency->exchange_rate * $usd)]);
            }
        }
    }

    public static function calculateCost($id)
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

    public static function getChartValues()
    {
        $currencies = Account::select('currency_id')->distinct()->pluck('currency_id');
        $currencySums = $currencies->mapWithKeys(callback: function ($item) {
            return [Currency::find($item)->title => Account::where('currency_id', $item)->sum('cost')];
        });
        $finalSum = $currencySums->sum();
        $topSums = $currencySums->sortDesc()->take(4);
        $percentages = $topSums->values()->map(callback: function ($item) use ($finalSum) {
            return $item / $finalSum * 100;
        });
        return [
            'labels' => $topSums->put('Other', $finalSum - $topSums->sum())->keys()->all(),
            'datasets' => $topSums->values()->all(),
            'percentages' => $percentages->push(100 - $percentages->sum())->all(),
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
}
