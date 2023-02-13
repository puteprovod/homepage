<?php

namespace App\Http\Controllers\Octopawn;

use App\Http\Controllers\Controller;
use App\Http\Requests\Octopawn\AnalyzeRequest;
use App\Http\Services\Octopawn\Game;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke()
    {
        $game = New Game();
        //$game->makeMove(3,3,2,2);
        //echo '<br> move coordx-coordy: 3-3 to 2-2:<br><br>';
        dump($game->minimax($game->field,3,false));
        //return response()->json(['color' =>$data['color'],'boardSituatuion' => $data['boardSituation']]);
    }

}
