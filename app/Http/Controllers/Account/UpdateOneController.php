<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateIndexRequest;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateOneController extends Controller
{
    public function __invoke(UpdateIndexRequest $request)
    {
        $data = $request->validated();
        $status='';
        if (Auth::guest()){
            return  [
                'status' => 'not_logged',
                'newCost' =>  0
            ];
        }
        if (Auth::user()['role']=='admin') {
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
        }
        else
        {
            $status='not_admin';
        }

        $response =[
            'status' => $status,
            'newCost' =>  Account::calculateCost($data['id'])
        ];
        return $response;

    }
}
