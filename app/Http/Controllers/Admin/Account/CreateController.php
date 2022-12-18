<?php

namespace App\Http\Controllers\Admin\Account;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;

class CreateController extends Controller
{
    public function __invoke()
    {
        $accounts=Account::All();
        $categories=Category::All();
        $currencies=Currency::All()->sortByDesc('priority');
        return view('admin.Account.create',compact('accounts', 'categories','currencies'));
    }
}
