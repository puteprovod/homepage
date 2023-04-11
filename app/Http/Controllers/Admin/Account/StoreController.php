<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\StoreRequest;
use App\Models\Account;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {

        try {
            Db::beginTransaction();

            $data = $request->validated();
            if (isset($data['image'])) {
                $data['image'] = Storage::disk('public')->put('/AccountImages', $data['image']);
            }
            $account = Account::create($data);

            Db::commit();
        } catch (\Exception $exception) {

            DB::rollBack();
            $account = $exception->getMessage();
        }

        Cache::tags('accounts')->flush();
       return redirect()->route('admin.accounts.index');
    }
}
