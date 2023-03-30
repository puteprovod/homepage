<?php

namespace App\Http\Services\Octopawn;

class Spider extends Figure implements Movable
{
    private const MOVE_ARRAY = [[0, -1,false], [0, 1,false], [-1, 0,false], [1, 0,false],
        [1, -1,false], [-1, -1,false], [-1, 1,false], [1, 1,false],
        [0, -1,true], [0, 1,true], [-1, 0,true], [1, 0,true],
        [1, -1,true], [-1, -1,true], [-1, 1,true], [1, 1,true]];
    public function getMovesArray (): array {
        return self::MOVE_ARRAY;
    }
}
