<?php

namespace App\Http\Controllers\Admin\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateRequest;
use App\Models\Account;
use App\Models\Currency;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Account $account)
    {
        $data = $request->validated();
        $account->update($data);
        $account->fresh();

        return redirect()->route('admin.accounts.show', $account->id);
    }
}
