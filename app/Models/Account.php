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
        $accounts = Account::all()->sortBy('id');
        $usd = Currency::find(11)->exchange_rate;
        foreach ($accounts as $account) {
            $currency = Currency::find($account->currency_id);
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
        $currencies = Currency::all();
        $currencySums = new Collection();
        foreach ($currencies as $currency) {
            $currencySums->put($currency->title, Account::where('currency_id', $currency->id)->sum('cost'));
        }
        $currencySums = $currencySums->sortDesc();
        $topSums = $currencySums->take(4);
        $finalSum = $currencySums->sum();
        $percentages = $topSums->values()->map(function ($item) use ($finalSum) {
            return $item / $finalSum * 100;
        });
        $topSums->put('Other', $finalSum - $topSums->sum());
        $percentages->push(100 - $percentages->sum());
        return [
            'labels' => $topSums->keys()->all(),
            'datasets' => $topSums->values()->all(),
            'percentages' => $percentages->all(),
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
