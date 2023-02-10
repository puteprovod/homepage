<?php

namespace App\Http\Services\Octopawn;

abstract class Figure
{

    public int $color;
    public Square $squareLink;
    public int $posX;
    public int $posY;
    public function __construct(int $color, int $posX, int $posY)
    {
        $this->color = $color;
        $this->posX = $posX;
        $this->posY = $posY;
    }
}
