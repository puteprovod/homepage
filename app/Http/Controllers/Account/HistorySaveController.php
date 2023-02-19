<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\HistorySaveRequest;
use App\Models\Account;
use App\Models\AccountHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistorySaveController extends Controller
{
    public function __invoke(HistorySaveRequest $request)
    {
        $data = $request->validated();
        $accounts = Account::all();
        $savingDate = Carbon::createFromFormat('d.m.Y', $data['savingDate'])->toDateTimeString();
        foreach ($accounts as $account){
            AccountHistory::create([
                'account_id' => $account->id,
                'value' => $account->value,
                'cost' => $account->cost,
                'shot_date' => $savingDate,
            ]);
        }
        return (['history' => AccountHistory::all()->where('shot_date',$savingDate),'date' => $data['savingDate']]);
    }
}
