<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __invoke(string $newLang = '')
    {
        return inertia('Main', compact('newLang')); //2
    }
}
