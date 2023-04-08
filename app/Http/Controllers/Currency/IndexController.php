<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Http\Resources\Currency\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke(string $newLang = '')
    {
        $result = Currency::getActualCurrencyInfo();
        $currencies = $result['currencies'];
        $errorMessage = $result['errorMessage'];
        //dd ($result);
        return inertia('Currency/Index', compact('currencies', 'errorMessage', 'newLang'));

    }
}
