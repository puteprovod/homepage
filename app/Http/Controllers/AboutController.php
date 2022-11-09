<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function index()
    {
        $can = (bool)Auth::user();
        return inertia('About',compact('can'));
    }
}
