<?php

namespace App\Http\Services\Octopawn;

class Game
{
    public const SQUARE_SIZE = 5; // FIELD SIZE
    public const PLAYER_COLOR = 'white'; // WHITE MOVES FIRST
    public const STARTING_FIELD =
        [["black", "black", "black", "black", "black"],
            ["none", "none", "none", "none", "none"],
            ["none", "none", "none", "none", "none"],
            ["none", "none", "none", "none", "none"],
            ["white", "white", "white", "white", "white"]];
//    public const STARTING_FIELD = [["black", "black", "black"],
//        ["none", "none", "none"],
//        ["white", "white", "white"]];
    public Field $field;

    public function __construct(array $field = self::STARTING_FIELD)
    {
        $this->field = new Field($field);
    }

    public function minimax(Field $field, $depth, bool $isMaximizing): array
    {
        $bestValue = ($isMaximizing) ? -INF : INF;
        $bestMove = null;
        $color = ($isMaximizing == true) ? 1 : 0;
        $validMoves = $this->getValidMoves($field,$color);

        if ($depth == 0 || count($validMoves) == 0) {
            return [$this->evaluateField($field,$color), null];
        }
        //echo ('depth'.$depth.'<br>');
        //echo ( '<br>ismaxx:'.$isMaximizing.'<br>');
        foreach ($validMoves as $move) {
            //echo ('simulating move: '.$move[0].'-'.$move[1].'->'.$move[2].'-'.$move[3].'<br>');
            //echo ('depth'.$depth.'<br>');
            $boardAfterMove = $field->simulateMove($move[0],$move[1],$move[2],$move[3]);
            //echo(nl2br($boardAfterMove->visualize()));
            $value = $this->minimax($boardAfterMove, $depth - 1, !$isMaximizing)[0];
            if ($isMaximizing && $value > $bestValue) {
                $bestValue = $value;
                $bestMove = $move;
            } else if (!$isMaximizing && $value < $bestValue) {
                $bestValue = $value;
                $bestMove = $move;
            }
        }
        return [$bestValue, $bestMove];
    }

    public function evaluateField(Field $field, $moveColor): float
    {
        // определение конца игры -9999 | +9999
        $figures = $field->figures;
        $blackFigureCount = 0;
        $whiteFigureCount = 0;
        $eval = 0;
        foreach ($figures as $figure) {
            $isCenterFigure = ($figure->posX == floor($field->xSize / 2) or $figure->posX == ceil($field->xSize / 2) - 1);
            if ($figure->color == 1) {
                $isCenterFigure ? $eval += 1.5 : $eval++;
                $eval+=($field->ySize-$figure->posY-1)/4;
                $whiteFigureCount++;
            } else {
                $isCenterFigure ? $eval += -1.5 : $eval--;
                $eval-=($figure->posY)/5;
                $blackFigureCount++;
            }
            if ($figure->posY == 0 and $figure->color == 1) return 9999;                     // белые дошли до конца
            if ($figure->posY == ($field->ySize - 1) and $figure->color == 0) return -9999;    // черные дошли до конца
        }
        if ($whiteFigureCount == 0) return -9999;                           // если белых не осталось
        if ($blackFigureCount == 0) return 9999;                            // если черных не осталось

        if ($moveColor == 1)
            if ($this->getValidMoves($field, 1) == [])
                return -9999;                                                // если пат у черных
        if ($moveColor == 0)
            if ($this->getValidMoves($field, 0) == [])
                return 9999;                                                 // если пат у белых
        return $eval;
    }
    public function isGameOver(Field $field, $moveColor): bool
    {
        // определение конца игры -9999 | +9999
        $figures = $field->figures;
        $blackFigureCount = 0;
        $whiteFigureCount = 0;
        $eval = 0;
        foreach ($figures as $figure) {
            if ($figure->color == 1) {
                $whiteFigureCount++;
            } else {
                $blackFigureCount++;
            }
            if ($figure->posY == 0 and $figure->color == 1) return true;                     // белые дошли до конца
            if ($figure->posY == ($field->ySize - 1) and $figure->color == 0) return true;    // черные дошли до конца
        }
        if ($whiteFigureCount == 0) return true;                           // если белых не осталось
        if ($blackFigureCount == 0) return true;                            // если черных не осталось

        return false;
    }
    public function makeMove($squareX, $squareY, $targetX, $targetY): void
    {
        $square = $this->field->getSquare($squareX, $squareY);
        $target = $this->field->getSquare($targetX, $targetY);
        $this->field->makeMove($square, $target);
        $this->field->refreshFigures();
    }

    public function getValidMoves(Field $field, int $color): array
    {
        if ($this->isGameOver($field,$color)) return [];
        $variants = [];
        $figures = $field->figures;
        foreach ($figures as $figure) {
            if ($figure->color == $color) {
                $figureX = $figure->posX;
                $figureY = $figure->posY;
                $moves = $figure->moveArray;
                $fights = $figure->fightArray;
                $k = $color ? 1 : -1; // коэффициент, корректирующий ходы для черных пешек
                foreach ($moves as $move) { // проверка возможности ходов
                    $newX = $figureX + $move[0] * $k;
                    $newY = $figureY + $move[1] * $k;
                    if (!(($newY >= $field->ySize or $newY < 0) or ($newX >= $field->xSize or $newX < 0)))
                        if (!$field->squares[$newX][$newY]->figure)
                            $variants[] = [$figureX, $figureY, $newX, $newY];
                }
                foreach ($fights as $fight) { // проверка возможности взятия чужих фигур
                    $newX = $figureX + $fight[0] * $k;
                    $newY = $figureY + $fight[1] * $k;
                    if (!(($newY >= $field->ySize or $newY < 0) or ($newX >= $field->xSize or $newX < 0))) {
                        if ($field->squares[$newX][$newY]->figure and $field->squares[$newX][$newY]->figure->color != $color)
                            $variants[] = [$figureX, $figureY, $newX, $newY];
                    }
                }
            }
        }
        return $variants;
    }
}
