<?php

namespace App\Http\Controllers\Admin\Account;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Currency;

class DestroyController extends Controller
{
    public function __invoke(Account $account)
    {
        $account->delete();
        return redirect()->route('admin.accounts.index');
    }
}
