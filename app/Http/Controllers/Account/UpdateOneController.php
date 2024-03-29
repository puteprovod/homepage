<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateIndexRequest;
use App\Http\Services\Account\Service;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UpdateOneController extends Controller
{
    public function __invoke(UpdateIndexRequest $request, Service $service)
    {
        $data = $request->validated();

        try {
            Db::beginTransaction();
            $account = Account::find($data['id']);
            $account->update($data);
            Db::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        if (isset($exception)) {
            $status = $exception->getMessage();
        } else {
            $status = 'ok';
        }

        $response = [
            'status' => $status,
            'newCost' => $service->calculateCost($data['id'])
        ];
        Cache::tags('accounts')->flush();
        return $response;
    }
}
