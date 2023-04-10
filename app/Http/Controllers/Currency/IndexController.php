<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Models\Currency;

class IndexController extends Controller
{
    public function __invoke(string $newLang = '')
    {
        $result = Currency::getActualCurrencyInfo();
        $currencies = $result['currencies'];
        $errorMessage = $result['errorMessage'];
        return inertia('Currency/Index', compact('currencies', 'errorMessage', 'newLang'));

    }
}
