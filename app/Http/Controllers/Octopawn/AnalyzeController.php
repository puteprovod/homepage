<?php

namespace App\Http\Controllers\Octopawn;

use App\Http\Controllers\Controller;
use App\Http\Requests\Octopawn\AnalyzeRequest;
use App\Http\Services\Octopawn\Game;
use Illuminate\Http\Request;

class AnalyzeController extends Controller
{
    public function __invoke(AnalyzeRequest $request, Game $game)
    {
        $data = $request->validated();
        $isMaximizing = ($data['color'] == 'white');
        $startTime = $this->getTime();
        switch ($data['fieldSize']) {
            case 999:
                $depth = ($data['difficulty']) ? 8 : 6;
                break;
            case 5:
                $depth = ($data['difficulty']) ? 9 : 6;
                break;
            case 4:
                $depth = ($data['difficulty']) ? 12 : 5;
                break;
            case 3:
                $depth = ($data['difficulty']) ? 12 : 1;
                break;
        }
        $resultArray = $game->minimax($game->field, $depth, $isMaximizing);
        $endTime = $this->getTime();
        $timeTaken = round(($endTime - $startTime), 2);
        $resultArray[] = $timeTaken;
        $resultArray[] = ($timeTaken > 0) ? round($resultArray[2] / $timeTaken, 0) : '-';

        return response()->json($resultArray);

    }

    private function getTime(): float|int
    {
        return array_sum(explode(" ", microtime()));
    }
}
