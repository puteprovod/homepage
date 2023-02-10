<?php

namespace App\Http\Services\Octopawn;

class Pawn extends Figure
{
    public array $moveArray = [1 => [0, -1]];
    public array $fightArray = [1 => [1, -1], 2 => [-1, -1]];
}
