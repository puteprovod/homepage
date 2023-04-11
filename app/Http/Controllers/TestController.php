<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Currency;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke()
    {
        return 'test';
    }
}
