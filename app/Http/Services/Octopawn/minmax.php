<?php
//
//function minimax($board, $depth, $isMaximizing, $alpha, $beta) {
//    $bestValue = ($isMaximizing) ? -INF : INF;
//    $bestMove = null;
//    $validMoves = getValidMoves($board);
//
//    if ($depth == 0 || count($validMoves) == 0) {
//        return [evaluateBoard($board), null];
//    }
//
//    foreach ($validMoves as $move) {
//        $boardAfterMove = makeMove($board, $move);
//        $value = minimax($boardAfterMove, $depth - 1, !$isMaximizing, $alpha, $beta)[0];
//        if ($isMaximizing && $value > $bestValue) {
//            $bestValue = $value;
//            $bestMove = $move;
//            $alpha = max($alpha, $value);
//        } else if (!$isMaximizing && $value < $bestValue) {
//            $bestValue = $value;
//            $bestMove = $move;
//            $beta = min($beta, $value);
//        }
//        if ($beta <= $alpha) {
//            break;
//        }
//    }
//
//    return [$bestValue, $bestMove];
//}
//
//?>
