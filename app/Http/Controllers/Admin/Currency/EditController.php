<?php

namespace App\Http\Controllers\Admin\Currency;
use App\Http\Controllers\Controller;
use App\Models\Currency;

class EditController extends Controller
{
    public function __invoke(Currency $currency)
    {
        $currencies = Currency::All();
        return view('admin.Currency.edit', compact('currency', 'currencies'));
    }
}
