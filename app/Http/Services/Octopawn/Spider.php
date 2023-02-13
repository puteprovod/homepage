<?php

namespace App\Http\Services\Octopawn;

class Spider extends Figure
{
    public const MOVE_ARRAY = [1 => [0, -1,false], 2 => [0, 1,false], 3 => [-1, 0,false], 4 => [1, 0,false],
        5 => [1, -1,false], 6 => [-1, -1,false], 7 => [-1, 1,false], 8 => [1, 1,false],
        9 => [0, -1,true], 10 => [0, 1,true], 11 => [-1, 0,true], 12 => [1, 0,true],
        13 => [1, -1,true], 14 => [-1, -1,true], 15 => [-1, 1,true], 16 => [1, 1,true]];
    public function getMovesArray (): array {
        return self::MOVE_ARRAY;
    }
}
