<?php

namespace App\Http\Controllers\Summary;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function __invoke(\App\Http\Services\Currency\Service $currencyService, \App\Http\Services\Account\Service $accountService)
    {
        $currencies = Collect($currencyService->currencies)->whereBetween('priority',[5,999])->sortByDesc('priority')->values()->toArray();
        $accountData = $accountService->getActualAccountsInfo();
        return inertia('Summary/Index',compact('currencies','accountData'));
    }


}
