<?php

namespace App\Http\Controllers\Account;
use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $accountCache = $this->service->getActualAccountsInfo();
        $accounts = $accountCache['accounts'];
        $history = $accountCache['history'];
        $historyDates = $accountCache['historyDates'];
        $chartValues = $accountCache['chartValues'];
        $role = Auth::user() ? Auth::user()['role'] : '';
        if ($role != 'admin') {
            $chartValues = $history = $historyDates = '';
            $i = 0;
            foreach ($accounts as $account)
                if ($i++ % 2 == 0)
                    unset ($accounts[$i]); // 1
        }
        $saveDate = now()->format('d.m.Y');
        return inertia('Account/Index', compact('accounts', 'saveDate', 'history', 'historyDates', 'chartValues'));  // VIEW
    }
}
