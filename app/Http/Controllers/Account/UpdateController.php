<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateIndexRequest;
use App\Http\Requests\Account\UpdateRequest;
use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UpdateController extends Controller
{
    public function __invoke(UpdateIndexRequest $request)
    {
        $data = $request->validated();
        $status='';
        try {
            Db::beginTransaction();
         foreach ($data['value'] as $key => $value) {
             $account = Account::find($key);
             $account->update(['value' => $value]);
         }
            Db::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        Account::calculateCosts();
        $accounts=DB::table('accounts')
            ->join('categories','accounts.category_id','=','categories.id')
            ->join('currencies','accounts.currency_id','=','currencies.id')
            ->select('accounts.*','categories.title as category_title','currencies.title as currency_title')
            ->orderBy('categories.title')
            ->get();
        $sum=$accounts->sum('cost');
        if (isset($exception)){
            $status=$exception->getMessage();
        }else{
            $status='ok';
        }
        return view('account.index', compact('accounts','status', 'sum'));
    }
}
