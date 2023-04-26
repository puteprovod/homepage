<?php

namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;
use App\Http\Services\Account\Service;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke(Service $service)
    {
        $accountCache = $service->getActualAccountsInfo();
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
                    unset ($accounts[$i]);
        }
        $saveDate = now()->format('d.m.Y');
        return inertia('Account/Index', compact('accounts', 'saveDate', 'history', 'historyDates', 'chartValues'));  // VIEW
    }
}
