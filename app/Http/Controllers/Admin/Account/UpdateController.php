<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateRequest;
use App\Models\Account;
use App\Models\Currency;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Account $account)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = Storage::disk('public')->put('/AccountImages', $data['image']);
            if ($account->image){
                Storage::disk('public')->delete($account->image);
            }
        }
        $account->update($data);
        $account->fresh();

        return redirect()->route('admin.accounts.show', $account->id);
    }
}
