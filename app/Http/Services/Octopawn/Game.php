<?php

namespace App\Http\Services\Octopawn;

class Game
{

    public const STARTING_FIELD =
        [["black", "black", "black", "black", "black"],
            ["none", "none", "none", "none", "none"],
            ["none", "none", "none", "none", "none"],
            ["none", "none", "none", "none", "none"],
            ["white", "white", "white", "white", "white"]];

    private int $boardsAnalyzed = 0;
    public Field $field;

    public function __construct(array $field = self::STARTING_FIELD)
    {
        $fieldSize = count($field[0]);
        $this->field = new Field($field, $fieldSize);
    }

    public function minimax(Field $field, int $depth, bool $isMaximizing, $alpha = -INF, $beta = +INF): array
    {
        $bestValue = ($isMaximizing) ? -INF : INF;
        $bestMove = null;
        $validMoves = $this->getValidMoves($field, $isMaximizing);
        if ($depth == 0 || count($validMoves) == 0) {
            return [$this->evaluateField($field, $isMaximizing), null];
        }
        foreach ($validMoves as $move) {
            $boardAfterMove = $field->simulateMove($move[0], $move[1], $move[2], $move[3]);
            $this->boardsAnalyzed++;
            $value = $this->minimax($boardAfterMove, $depth - 1, !$isMaximizing, $alpha, $beta)[0];
            if ($isMaximizing && $value > $bestValue) {
                $bestValue = $value;
                $bestMove = $move;
                $alpha = max($alpha, $value);
            } else if (!$isMaximizing && $value < $bestValue) {
                $bestValue = $value;
                $bestMove = $move;
                $beta = min($beta, $value);
            }
            if ($beta < $alpha) {
                break;
            }
        }
        return [$bestValue, $bestMove, $this->boardsAnalyzed];
    }

    public function evaluateField(Field $field, bool $moveColor): float
    {
        // определение конца игры -9999 | +9999
        $figures = $field->figures;
        $fieldSize = $field->fieldSize;
        $eval = 0;
        foreach ($figures as $figure) {
            if (str_contains($figure->name, 'spider')) {
                ($figure->color) ? $eval += 3 : $eval -= 3;
            } else {
                $isFlankFigure = (($figure->posX == 0) or ($figure->posX == ($fieldSize - 1)));
                if ($figure->color) {
                    $isFlankFigure ? $eval++ : $eval += 1.7;
                    $eval += ($fieldSize - $figure->posY - 1) / ($fieldSize);
                } else {
                    $isFlankFigure ? $eval-- : $eval -= 1.7;
                    $eval -= ($figure->posY) / ($fieldSize);
                }
                if ($figure->posY == 0 and $figure->color) return 9999;                     // белые дошли до конца
                if ($figure->posY == ($field->fieldSize - 1) and !$figure->color) return -9999;    // черные дошли до конца
            }
        }
        if ($this->getValidMoves($field, $moveColor) == [])
            return ($moveColor) ? -9999 : +9999;
        return round($eval, 3);
    }

    public function isGameOver(Field $field): bool
    {
        // определение конца игры -9999 | +9999
        foreach ($field->figures as $figure) {
            if (!str_contains($figure->name, 'spider')) {
                if ($figure->posY == 0 and $figure->color) return true;                     // белые дошли до конца
                if ($figure->posY == ($field->fieldSize - 1) and !$figure->color and !str_contains($figure->name, 'spider')) return true;    // черные дошли до конца
            }
        }
        return false;
    }

    public function getValidMoves(Field $field, bool $color): array
    {
        if ($this->isGameOver($field)) return [];
        $variants = [];
        $figures = $field->figures;
        $fieldSize = $field->fieldSize;
        foreach ($figures as $figure) {
            if ($figure->color == $color) {
                $figureX = $figure->posX;
                $figureY = $figure->posY;
                $moves = $figure->getMovesArray();
                foreach ($moves as $move) {
                    $k = $color ? 1 : -1;
                    $newX = $figureX + $move[0] * $k;
                    $newY = $figureY + $move[1] * $k;
                    if (!(($newY >= $fieldSize or $newY < 0) or ($newX >= $fieldSize or $newX < 0))) {
                        if ($move[2]) {
                            if ($field->squares[$newX][$newY]->figure and ($field->squares[$newX][$newY]->figure->color != $color))
                                $variants[] = [$figureX, $figureY, $newX, $newY];
                        } else {
                            if (!$field->squares[$newX][$newY]->figure)
                                $variants[] = [$figureX, $figureY, $newX, $newY];
                        }
                    }
                }
            }
        }
        return $variants;
    }
}
