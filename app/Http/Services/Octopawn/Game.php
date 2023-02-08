<?php

namespace App\Http\Services\Octopawn;

class Game
{
    public const SQUARE_SIZE = 4; // FIELD SIZE
    public const PLAYER_COLOR = 'white'; // WHITE MOVES FIRST
    public const STARTING_FIELD = [
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
    public int $turn;

    public Field $field;

    public function __construct(array $field, $move)
    {

    }
}
