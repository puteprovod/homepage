<?php

namespace App\Http\Controllers\Octopawn;

use App\Http\Controllers\Controller;
use App\Http\Services\Octopawn\Game;

class IndexController extends Controller
{
    public function __invoke()
    {
        $startingField = Game::STARTING_FIELD;
        $squareSize = Game::FIELD_SIZE;
        $playerColor = Game::PLAYER_COLOR;
        return inertia('Octopawn/Index', compact('startingField', 'squareSize', 'playerColor'));
    }
}
