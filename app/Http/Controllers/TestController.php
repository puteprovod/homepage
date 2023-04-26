<?php

namespace App\Http\Controllers;

use App\Http\Services\Python\PythonService;
use App\Models\Account;
use App\Models\Currency;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke()
    {
        $color = false;
      dump ($color <=> !$color);
        $color = true;
        dump ($color <=> !$color);




    }
}
