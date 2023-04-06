<?php

namespace App\Http\Controllers\Admin\Account;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountHistory;

class DestroyController extends Controller
{
    public function __invoke(Account $account)
    {
        AccountHistory::where('account_id',$account->id)->delete();
        $account->delete();
        return redirect()->route('admin.accounts.index');
    }
}
