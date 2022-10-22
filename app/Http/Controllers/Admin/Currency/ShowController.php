<?php

namespace App\Http\Controllers\Admin\Currency;
use App\Http\Controllers\Controller;
use App\Models\Currency;

class ShowController extends Controller
{
    public function __invoke(Currency $currency)
    {
        $currencies=Currency::All();
       return view('admin.currency.show', compact('currency','currencies'));
    }
}
