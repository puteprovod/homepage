<?php

namespace App\Http\Controllers\Admin\Currency;
use App\Http\Controllers\Controller;
use App\Models\Currency;

class DestroyController extends Controller
{
    public function __invoke(Currency $currency)
    {
        $currency->delete();
        return redirect()->route('admin.currencies.index');
    }
}
