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
        $resultArray = $game->minimax($game->field,6,$isMaximizing);
        return response()->json($resultArray);
        //return response()->json(['color' =>$data['color'],'boardSituatuion' => $data['boardSituation']]);
    }

}
