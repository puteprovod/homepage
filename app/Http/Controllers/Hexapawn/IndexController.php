<?php

namespace App\Http\Controllers\Hexapawn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        return inertia('Hexapawn/Index');
    }
}
