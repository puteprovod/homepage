<?php

namespace App\Http\Controllers;


class AboutController extends Controller
{
    public function index()
    {
        return inertia('About'); //1
    }
}
