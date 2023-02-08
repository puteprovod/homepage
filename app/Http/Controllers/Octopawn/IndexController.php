<?php

namespace App\Http\Controllers\Octopawn;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $squareSize = 4;
        $startingField = [
            1 => [
                1 => 'black',
                2 => 'black',
                3 => 'black',
                4 => 'black',
            ],
            2 => [
                1 => 'none',
                2 => 'none',
                3 => 'none',
                4 => 'none',
            ],
            3 => [
                1 => 'white',
                2 => 'black',
                3 => 'white',
                4 => 'black',
            ],
            4 => [
                1 => 'white',
                2 => 'white',
                3 => 'white',
                4 => 'white',
            ],
        ];
        return inertia('Octopawn/Index', compact('startingField', 'squareSize')); //VIEW
    }
}
