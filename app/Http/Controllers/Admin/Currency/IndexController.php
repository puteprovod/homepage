<?php

namespace App\Http\Controllers\Admin\Currency;

use App\Http\Controllers\Controller;
use App\Models\Currency;

class IndexController extends Controller
{
    public function __invoke()
    {
        $currencies=Currency::where('title','!=','RUB')->get();
        return view('admin.Currency.index', compact('currencies'));
    }
}
