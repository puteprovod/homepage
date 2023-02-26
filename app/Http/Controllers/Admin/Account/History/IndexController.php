<?php

namespace App\Http\Controllers\Admin\Account\History;

use App\Http\Controllers\Controller;
use App\Models\AccountHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __invoke()
    {
        $historyDatesCollection = DB::table('account_histories')
            ->select('shot_date')->orderByDesc('shot_date')->distinct()->get();
        $accountHistories = [];
        $i=0;
        foreach ($historyDatesCollection as $date) {
            $historyDate = $date->shot_date;
            $accountHistories[] = [
                'id' => ++$i,
                'dateTime' => Carbon::parse($historyDate)->format('d.m.Y H:i:s'),
                'shotDate' => $historyDate,
                'cost' =>  number_format( AccountHistory::all()->where('shot_date',$historyDate)->sum('cost'), 0, ',', ' ' )
            ];
        }
        return view('admin.account.history.index', compact('accountHistories'));
    }
}
