<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function __invoke()
    {

        $errorMessage=Currency::refreshFromAPI();
        $currencies = Currency::All()->sortByDesc('priority');
        return view('currencies', compact('currencies','errorMessage'));
    }
}
