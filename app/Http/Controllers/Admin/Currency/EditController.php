<?php

namespace App\Http\Controllers\Admin\Currency;
use App\Http\Controllers\Controller;
use App\Models\Currency;

class EditController extends Controller
{
    public function __invoke(Currency $currency)
    {
        $currencies = Currency::All();
        if ($currency->title!='RUB'){
        return view('admin.currency.edit', compact('currency', 'currencies'));
        }
        else
        {
            return redirect()->route('admin.currencies.index');
        }
    }
}
