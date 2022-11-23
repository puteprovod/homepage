<?php

namespace App\Http\Controllers\Resizer;

use App\Http\Controllers\Controller;
use App\Models\ResizedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ResultController extends Controller
{
    public function __invoke($token)
    {
        $data=ResizedImage::all()->where('token',$token);
        $sizeSum = $data->sum('size')/1000;
        return inertia('Resizer/Result', compact ('data','token', 'sizeSum'));
    }
}
