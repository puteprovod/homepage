<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Http\Services\Currency\Service;

class IndexController extends Controller
{
    public function __invoke(Service $service, string $newLang = '')
    {
        $currencies = $service->currencies;
        $errorMessage = $service->errorMessage;
        return inertia('Currency/Index', compact('currencies', 'errorMessage', 'newLang'));

    }
}
