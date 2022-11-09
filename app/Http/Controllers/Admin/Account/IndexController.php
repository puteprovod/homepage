<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Currency;

class IndexController extends Controller
{
    public function __invoke()
    {
        $accounts=Account::All();
        $account=$accounts->find(2);
        return view('admin.Account.index', compact('accounts'));
    }
}
