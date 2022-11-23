<?php

namespace App\Http\Controllers\Resizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function __invoke()
    {
        return inertia('Resizer/Index');
    }
}
