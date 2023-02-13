<?php

namespace App\Http\Services\Octopawn;

class Field
{
    public int $fieldSize;
    public array $squares;
    public array $figures;

    public function __construct(array $field, int $fieldSize)
    {
        for ($y = 0; $y < $fieldSize; $y++) {
            for ($x = 0; $x < $fieldSize; $x++) {
                $this->squares[$x][$y] = new Square($x, $y, $this->getFigureFromString($field[$y][$x], $x, $y));
                if ($this->squares[$x][$y]->figure)
                    $this->figures[] =& $this->squares[$x][$y]->figure;
            }
        }
        $this->fieldSize = $fieldSize;
    }

    public function toArray(): array
    {
        $array = [];
        for ($y = 0; $y < $this->fieldSize; $y++) {
            for ($x = 0; $x < $this->fieldSize; $x++) {
                if ($figure = $this->squares[$x][$y]->figure) {
                    $array[$y][] = $figure->name;
                } else {
                    $array[$y][] = '';
                }
            }
        }
        return $array;
    }

    public function simulateMove(int $posX, int $posY, int $targetX, int $targetY): Field
    {
        $clonedField = new Field ($this->toArray(), $this->fieldSize);
        $square1 = $clonedField->squares[$posX][$posY];
        $square2 = $clonedField->squares[$targetX][$targetY];
        $killMove = isset($square2->figure);
        $square2->figure = $square1->figure;
        $square2->figure->posX = $square2->xPos;
        $square2->figure->posY = $square2->yPos;
        $square1->figure = null;
        if (!$killMove)
            $clonedField->figures[] = &$square2->figure;
        $clonedField->figures = array_filter($clonedField->figures);
        return $clonedField;
    }

    public function visualize(): string
    {
        $string = '';
        for ($y = 0; $y < $this->fieldSize; $y++) {
            for ($x = 0; $x < $this->fieldSize; $x++) {
                $square = $this->squares[$x][$y];
                $string .= ($square->figure) ? $square->figure->color : '_';
            }
            $string .= PHP_EOL;
        }
        return $string;
    }

    private function getFigureFromString(string $squareString, int $posX, int $posY): Figure|null
    {
        return match ($squareString) {
            'white' => new Pawn(true, $posX, $posY, $squareString),
            'black' => new Pawn(false, $posX, $posY, $squareString),
            'white spider' => new Spider(true, $posX, $posY, $squareString),
            'black spider' => new Spider(false, $posX, $posY, $squareString),
            default => null,
        };
    }
}
