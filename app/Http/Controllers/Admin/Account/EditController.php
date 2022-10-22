<?php

namespace App\Http\Controllers\Admin\Account;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;

class EditController extends Controller
{
    public function __invoke(Account $account)
    {
        $accounts = Account::All();
        $categories=Category::All();
        $currencies=Currency::All()->sortByDesc('priority');
        if ($account->title!='RUB'){
        return view('admin.account.edit', compact('account', 'accounts','categories','currencies'));
        }
        else
        {
            return redirect()->route('admin.accounts.index');
        }
    }
}
