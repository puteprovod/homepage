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
        $accounts = DB::table('accounts')
            ->join('categories', 'accounts.category_id', '=', 'categories.id')
            ->join('currencies', 'accounts.currency_id', '=', 'currencies.id')
            ->select('accounts.*', 'categories.title as category_title', 'currencies.title as currency_title')
            ->orderBy('categories.title')
            ->get();
        $accounts = AccountResource::collection($accounts)->resolve();
        $saveDate = Carbon::now()->format('d.m.Y');
        $history=[];
        $historyDates=[];
        $historyDatesCollection = DB::table('account_histories')
            ->select('shot_date')->orderByDesc('shot_date')->distinct()->get();
        $role=Auth::user() ? Auth::user()['role'] : '';
        if ($role!='admin'){
            $i=0;
            foreach ($accounts as $account) {
                if ($i++%2==0)
                    unset ($accounts[$i]);

            }
        }
        if ($historyDatesCollection and $role=='admin') {
            foreach ($historyDatesCollection as $date) {
                $historyDate = $date->shot_date;
                $history[] = AccountHistory::all()->where('shot_date', $historyDate);
                $historyDates[] = Carbon::parse($historyDate)->format('d.m.Y');
            }
        }
        $chartValues = ($role=='admin') ? Account::getChartValues() : '';

        return inertia('Account/Index', compact('accounts', 'saveDate','history', 'historyDates','chartValues'));  // VIEW
    }
}
