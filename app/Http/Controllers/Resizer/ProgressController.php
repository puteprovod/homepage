<?php

namespace App\Http\Controllers\Resizer;

use App\Http\Controllers\Controller;
use App\Models\ResizedImage;

class ProgressController extends Controller
{

    public function __invoke($token)
    {
        $progress=ResizedImage::all()->where('token',$token)->count();
        return response()->json(['progress' => $progress]);

    }

}
