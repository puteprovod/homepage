<?php

namespace App\Http\Controllers\Admin\Currency;
use App\Http\Controllers\Controller;
use App\Models\Currency;

class CreateController extends Controller
{
    public function __invoke()
    {
        $currencies=Currency::All();
        return view('admin.Currency.create',compact('currencies'));
    }
}
