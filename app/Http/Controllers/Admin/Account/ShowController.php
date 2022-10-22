<?php

namespace App\Http\Controllers\Admin\Account;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Currency;

class ShowController extends Controller
{
    public function __invoke(Account $account)
    {
        $accounts=Account::All();
       return view('admin.account.show', compact('account','accounts'));
    }
}
