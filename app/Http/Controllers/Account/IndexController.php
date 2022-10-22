<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function __invoke()
    {
        Account::calculateCosts();
        $accounts=DB::table('accounts')
            ->join('categories','accounts.category_id','=','categories.id')
            ->join('currencies','accounts.currency_id','=','currencies.id')
            ->select('accounts.*','categories.title as category_title','currencies.title as currency_title')
            ->orderBy('categories.title')
            ->get();
        //$accounts=Account::select('accounts.*','categories.title')->join('categories','categories.id','=','accounts.category_id');
        $sum=$accounts->sum('cost');
        $status='';
        return view('account.index', compact('accounts','sum','status'));
    }
}
