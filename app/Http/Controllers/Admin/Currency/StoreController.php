<?php

namespace App\Http\Controllers\Admin\Currency;

use App\Http\Controllers\Controller;
use App\Http\Requests\Currency\StoreRequest;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        try {
            Db::beginTransaction();

            $data = $request->validated();
            $currency = Currency::create($data);
            Db::commit();
        } catch (\Exception $exception) {

            DB::rollBack();
            $currency = $exception->getMessage();
        }

       return redirect()->route('admin.currencies.index');
    }
}
