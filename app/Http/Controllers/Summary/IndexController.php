<?php

namespace App\Http\Controllers\Summary;

use App\Http\Controllers\Controller;
use App\Http\Services\Currency\Service;
use App\Models\Currency;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __invoke()
    {
        $result = Service::getActualCurrencyInfo();
        $currencies = Collect($result['currencies'])->whereBetween('priority',[5,999])->sortByDesc('priority')->values()->toArray();

        $accountService = new \App\Http\Services\Account\Service();
        $accountData = $accountService->getActualAccountsInfo();
        return inertia('Summary/Index',compact('currencies','accountData'));
    }


}
