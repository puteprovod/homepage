<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function index()
    {
        $role=Auth::user() ? Auth::user()['role'] : '';
        if ($role!='admin') {
        return inertia('Chart');
        }
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
        return inertia('Chart', compact('labels','datasets', 'percentages'));
    }
}
