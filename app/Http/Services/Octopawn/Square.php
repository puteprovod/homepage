<?php

namespace App\Http\Services\Octopawn;

class Square
{
    public int $xPos;
    public int $yPos;
    public Figure|null $figure;

    public function __construct($x,$y,Figure|null $figure = null)
    {
        $this->xPos = $x;
        $this->yPos = $y;
        $this->figure = $figure;
    }
}
