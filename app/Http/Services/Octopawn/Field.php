<?php

namespace App\Http\Services\Octopawn;

class Field
{
    public array $squares;
    public int $xSize;
    public int $ySize;
    public array $figures;

    public function __construct(array $field)
    {
        $ySize = Count($field);
        $xSize = Count($field[0]);
        for ($y = 0; $y < $ySize; $y++) {
            for ($x = 0; $x < $xSize; $x++) {
                $this->squares[$x][$y] = new Square($x, $y, $this->getFigureFromString($field[$y][$x], $x, $y));
                if ($field[$y][$x] == 'white' or $field[$y][$x] == 'black') {
                    $this->figures[] =& $this->squares[$x][$y]->figure;
                }
            }
        }
        $this->xSize = $xSize;
        $this->ySize = $ySize;
    }
    public function toArray(): array
    {
        $array = [];
        for ($y=0; $y<$this->ySize;$y++){
            for ($x=0; $x<$this->xSize;$x++){
                if ($this->squares[$x][$y]->figure)
                {
                    ($this->squares[$x][$y]->figure->color == 1) ? $array[$y][] = 'white' : $array[$y][] = 'black' ;
                }
                else
                {
                    $array[$y][] = 'none' ;
                }
            }
        }
        return $array;
    }
    public function makeMove(Square $square1, Square $square2): void
    {
        $killMove = isset($square2->figure);
        $square2->figure = clone $square1->figure;
        $square2->figure->posX = $square2->xPos;
        $square2->figure->posY = $square2->yPos;
        $square1->figure = null;
        if (!$killMove)
            $this->figures[] = &$square2->figure;
    }

    public function simulateMove($posX, $posY, $targetX, $targetY): Field
    {
        $exchangeArray = $this->toArray();
        $clonedField = New Field ($exchangeArray);
        if (!$clonedField->squares[$posX][$posY]->figure) {
            echo $posX . '-' . $posY . ' ' . $targetX . '-' . $targetY;
        }
        $square1 = $clonedField->squares[$posX][$posY];
        $square2 = $clonedField->squares[$targetX][$targetY];
        $killMove = isset($square2->figure);
        $square2->figure = clone $square1->figure;
        $square2->figure->posX = $square2->xPos;
        $square2->figure->posY = $square2->yPos;
        $square1->figure = null;
        //dump ($square1->figure);
        //dump ($square2->figure);
        if (!$killMove)
            $clonedField->figures[] = &$square2->figure;
        $clonedField->refreshFigures();
        return $clonedField;

    }

    public function refreshFigures(): void
    {
        $figures = $this->figures;
        foreach ($figures as $key => $figure)
            if ($figure == null) {
                unset ($this->figures[$key]);
            }
    }

    public function getSquare($x, $y): Square
    {
        return $this->squares[$x][$y];
    }

    public function visualize(): string
    {
        $string = '';
        for ($y = 0; $y < $this->ySize; $y++) {
            for ($x = 0; $x < $this->xSize; $x++) {
                $square = $this->getSquare($x, $y);
                if ($square->figure) {
                    $string .= $square->figure->color ;
                } else {
                    $string .= '_';
                }
            }
            $string .= PHP_EOL;
        }
        return $string;
    }

    private function getFigureFromString(string $squareString, int $posX, int $posY): Figure|null
    {
        switch ($squareString) {
            case 'white':
                return new Pawn(1, $posX, $posY);
            case 'black':
                return new Pawn(0, $posX, $posY);
        }
        return null;
    }
}
