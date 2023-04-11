<?php

namespace App\Models;

use App\Components\ImportCurrenciesClient;
use App\Http\Resources\Currency\CurrencyResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Currency extends Model
{
    protected $table = 'currencies';
    protected $guarded = [];
    use HasFactory;


    public function accounts()
    {
        return $this->hasMany(Account::Class, 'currency_id', 'id');
    }
}
