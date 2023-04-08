<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account\AccountResource;
use App\Models\Account;
use App\Models\AccountHistory;
use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
        Cache::tags('default')->flush();
        Cache::tags('default')->rememberForever('key1',function (){
            return 100;
        });
        Cache::tags('default')->increment('key1',10);
        dump (Cache::tags('default')->get('key1'));
        Cache::rememberForever('key1',function(){
           return 100;
        });
        Cache::increment('key1');
        dump(Cache::get('key1'));
        Account::calculateCosts();
        $accounts = DB::table('accounts')
            ->join('categories', 'accounts.category_id', '=', 'categories.id')
            ->join('currencies', 'accounts.currency_id', '=', 'currencies.id')
            ->select('accounts.*', 'categories.title as category_title', 'currencies.title as currency_title')
            ->orderBy('categories.title')
            ->get();
        $accounts = AccountResource::collection($accounts)->resolve();
        $saveDate = Carbon::now()->format('d.m.Y');

        $historyDatesCollection = AccountHistory::all()
            ->pluck('shot_date')->unique()->sortDesc()->values();

        $history = $historyDates = [];
        if ($historyDatesCollection) {
            $history = $historyDatesCollection->map(function ($item) {
                return AccountHistory::all()->where('shot_date', $item);
            })->toArray();
            $historyDates = $historyDatesCollection->map(function ($item) {
                return Carbon::parse($item)->format('d.m.Y');
            })->toArray();
        }
        $chartValues = Account::getChartValues();

        $role = Auth::user() ? Auth::user()['role'] : '';
        if ($role != 'admin') {
            $chartValues = $history = $historyDates = '';
            $i = 0;
            foreach ($accounts as $account)
                if ($i++ % 2 == 0)
                    unset ($accounts[$i]);
        }

        return inertia('Account/Index', compact('accounts', 'saveDate', 'history', 'historyDates', 'chartValues'));  // VIEW
    }
}
