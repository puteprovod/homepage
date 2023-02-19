<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\AccountResource;
use App\Models\Account;
use App\Models\AccountHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $sum = 0;
        $accounts = AccountResource::collection($accounts)->resolve();
        foreach ($accounts as $account) {
            $sum += $account['cost'];
        }
        $saveDate = Carbon::now()->format('d.m.Y');
        if (AccountHistory::all()->last()) {
            $historyDate = AccountHistory::all()->last()->shot_date;
            $history = AccountHistory::all()->where('shot_date', $historyDate);
            $historyDate = Carbon::parse($historyDate)->format('d.m.Y');
        }else{
            $history='';
            $historyDate='';
        }
        return inertia('Account/Index', compact('accounts', 'sum','saveDate','history', 'historyDate'));  // VIEW
    }
}
