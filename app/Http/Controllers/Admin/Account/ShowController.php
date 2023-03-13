<?php

namespace App\Http\Controllers\Admin\Account;
use App\Http\Controllers\Controller;
use App\Models\Account;

class ShowController extends Controller
{
    public function __invoke(Account $account)
    {
        $accounts=Account::All();
       return view('admin.Account.show', compact('account','accounts')); //Account1
    }
}
