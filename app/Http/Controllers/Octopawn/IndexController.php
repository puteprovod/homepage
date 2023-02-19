<?php

namespace App\Http\Controllers\Octopawn;

use App\Http\Controllers\Controller;
use App\Http\Requests\Octopawn\IndexRequest;
use App\Http\Services\Octopawn\Game;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();
        $fieldSize = $data['fieldSize'] ?? 4;
        $difficulty = $data['difficulty'] ?? 0;
        $startingField = self::FIELDS[$fieldSize];
        $squareSize = 0;
        switch ($fieldSize) {
            case 3:
                $squareSize = 3;
                break;
            case 4:
                $squareSize = 4;
                break;
            case 999:
            case 5:
                $squareSize = 5;
                break;
        }
        $playerColor = self::PLAYER_COLOR;
        return inertia('Octopawn/Index', compact('startingField', 'squareSize', 'playerColor', 'difficulty', 'fieldSize'));

    }

    private const PLAYER_COLOR = 'white'; // WHITE MOVES FIRST
    private const FIELDS = [
        3 =>
            [["black", "black", "black"],
                ["none", "none", "none"],
                ["white", "white", "white"]],
        4 =>
            [["black", "black", "black", "black"],
                ["none", "none", "none", "none"],
                ["none", "none", "none", "none"],
                ["white", "white", "white", "white"]],
        5 =>
            [["black", "black", "black", "black", "black"],
                ["none", "none", "none", "none", "none"],
                ["none", "none", "none", "none", "none"],
                ["none", "none", "none", "none", "none"],
                ["white", "white", "white", "white", "white"]],
        999 =>
            [["black", "black spider", "none", "black spider", "black"],
                ["none", "none", "none", "none", "none"],
                ["none", "none", "none", "none", "none"],
                ["none", "none", "none", "none", "none"],
                ["white", "white", "white", "white", "white"]],
    ];

}
