<?php

namespace App\Http\Services\Octopawn;

abstract class Figure
{
    public bool $color;
    public int $posX;
    public int $posY;
    public string $name;
    public function __construct(bool $color, int $posX, int $posY, string $name)
    {
        $this->color = $color;
        $this->posX = $posX;
        $this->posY = $posY;
        $this->name = $name;

    }
}
