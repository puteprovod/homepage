<?php

namespace App\Http\Controllers\Octopawn;

use App\Http\Controllers\Controller;
use App\Http\Requests\Octopawn\AnalyzeRequest;
use App\Http\Services\Octopawn\Game;
use Illuminate\Http\Request;

class AnalyzeController extends Controller
{
    public function __invoke(AnalyzeRequest $request)
    {
        $data = $request->validated();
        $game = New Game($data['boardSituation']);
        $isMaximizing = $data['color']=='white';
        //if ($game->isGameOver($game->field))
        $startTime = $this->getTime();
        $resultArray = $game->minimax($game->field,10,$isMaximizing);
        $endTime = $this->getTime();
        $timeTaken = round(($endTime - $startTime),2);
        $resultArray[] = $timeTaken.' sec';

        $resultArray[] = ($timeTaken>0) ? round($resultArray[2]/$timeTaken,0).' b/s' : '- b/s';

        return response()->json($resultArray);
        //return response()->json(['color' =>$data['color'],'boardSituatuion' => $data['boardSituation']]);

    }
    private function getTime(): float|int
    {
        return array_sum(explode(" ", microtime()));
    }
}
