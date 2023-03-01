<?php

namespace App\Http\Controllers\Admin\Account\History;

use App\Http\Controllers\Controller;
use App\Models\AccountHistory;

class DestroyController extends Controller
{
    public function __invoke(String $dateTime)
    {
        $history = AccountHistory::where('shot_date',$dateTime);
        $history->delete();
        return redirect()->route('admin.Accounts.history.index');
    }
}
