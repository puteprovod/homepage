<?php

namespace App\Models;

use App\Models\Trades\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';
    protected $guarded = [];

    use HasFactory;
    use Filterable;

    public static function calculateCosts()
    {
        $accounts = Account::all()->sortBy('id');
        foreach ($accounts as $account) {
            $currency = Currency::find($account->currency_id);
            if ($currency->source == 'cbr' or $currency->source == 'rub') {

                $account->update(['cost' => ceil($account->value * $currency->exchange_rate)]);
            } else {
                $usd = Currency::find(11)->exchange_rate;
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

    public static function getChartValues() {
        $labels = [];
        $datasets = [];
        $percentages = [];
        $currencies = Currency::all();
        $currencySums = [];
        $topSum = 0;
        foreach ($currencies as $currency) {
            $currencySums[$currency->title] = Account::where('currency_id',$currency->id)->sum('cost');
        }
        arsort($currencySums);
        $i = 0;
        foreach ($currencySums as $key => $currencySum){
            $i++;
            if ($currencySum==0) break;
            if ($i<=4) {
                $labels[] = $key;
                $datasets[] = $currencySum;
                $topSum+=$currencySum;
            }
        }
        $finalSum = array_sum($currencySums);
        foreach($datasets as $dataset){
            $percentages[] = $dataset/$finalSum*100;
        }
        $labels[] = 'Other';
        $datasets[] = $finalSum - array_sum($datasets);
        $percentages[] = 100 - array_sum($percentages);

        return [
            'labels' => $labels,
            'datasets' => $datasets,
            'percentages' => $percentages,
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
