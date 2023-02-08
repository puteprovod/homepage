<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\AccountResource;
use App\Models\Account;
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
        return inertia('Account/Index', compact('accounts', 'sum'));  // VIEW
    }
}
