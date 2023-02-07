<?php

namespace App\Http\Services\Hexapawn;

class Game
{
    const FIELDXSIZE = 3; // SIZE OF FIELD BY X AXIS
    const FIELDYSIZE = 3; // SIZE OF FIELD BY Y AXIS
    const FIRSTMOVE = 1; // WHITE MOVES FIRST

    public int $turn;

    public Field $field;
    public function __construct(int $firstmove)
    {

    }
}
