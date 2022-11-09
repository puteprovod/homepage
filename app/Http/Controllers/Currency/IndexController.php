<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Http\Resources\Currency\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function __invoke()
    {

        $errorMessage=Currency::refreshFromAPI();
        $currencies = Currency::All()->sortByDesc('priority');
        $currencies = CurrencyResource::collection($currencies)->resolve();
        $can = (bool)Auth::user();
        return inertia('Currency/Index', compact('currencies','errorMessage', 'can'));

    }
}
