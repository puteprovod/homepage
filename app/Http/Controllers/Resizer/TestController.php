<?php

namespace App\Http\Controllers\Resizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class TestController extends Controller
{
    public function getWidthHeight () {
        return [
          'width' => 120,
          'height' => 200
        ];
    }
    public function __invoke()
    {
        exec("python3 ../kart3.py storage/ResizedImages/Request.json 2>&1", $output);
        dd ($output);
    }
}
