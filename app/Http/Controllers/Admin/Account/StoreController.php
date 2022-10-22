<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\StoreRequest;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        try {
            Db::beginTransaction();

            $data = $request->validated();
            $account = Account::create($data);
            Db::commit();
        } catch (\Exception $exception) {

            DB::rollBack();
            $account = $exception->getMessage();
        }

       return redirect()->route('admin.accounts.index');
    }
}
