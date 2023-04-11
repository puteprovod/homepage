<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\HistorySaveRequest;
use App\Http\Resources\Account\AccountResource;
use App\Mail\Account\HistoryMail;
use App\Models\Account;
use App\Models\AccountHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class HistorySaveController extends BaseController
{
    public function __invoke(HistorySaveRequest $request)
    {
        $data = $request->validated();
        $accounts = Account::all();
        $savingDate = Carbon::createFromFormat('d.m.Y', $data['savingDate'])->toDateTimeString();
        foreach ($accounts as $account) {
            AccountHistory::create([
                'account_id' => $account->id,
                'value' => $account->value,
                'cost' => $account->cost,
                'shot_date' => $savingDate,
            ]);
        }
        $sum = $accounts->sum('cost');
        $accounts = AccountResource::collection($accounts)->resolve();
        Mail::to('serg-419@yandex.ru')->send(new HistoryMail($accounts, $sum, $data['savingDate']));
        return (['history' => AccountHistory::where('shot_date', $savingDate)->get(), 'date' => $data['savingDate']]);
    }
}
