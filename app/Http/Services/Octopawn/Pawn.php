<?php

namespace App\Http\Services\Octopawn;

class Pawn extends Figure implements Movable
{

    private const MOVE_ARRAY = [[1, -1,true], [-1, -1,true], [0,-1,false]];
    public function getMovesArray(): array {
        return self::MOVE_ARRAY;
    }
}
