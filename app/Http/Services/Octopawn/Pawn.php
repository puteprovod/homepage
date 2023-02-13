<?php

namespace App\Http\Services\Octopawn;

class Pawn extends Figure
{

    private const MOVE_ARRAY = [1 => [1, -1,true], 2 => [-1, -1,true], 3=> [0,-1,false]];
    public function getMovesArray(): array {
        return self::MOVE_ARRAY;
    }
}
