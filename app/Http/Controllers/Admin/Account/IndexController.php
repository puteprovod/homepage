<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Account;

class IndexController extends Controller
{
    public function __invoke()
    {
        $accounts=Account::all();
        //dd ($accounts);
        return view('admin.Account.index', compact('accounts'));
    }
}
