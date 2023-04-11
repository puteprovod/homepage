<?php

namespace App\Models;

use App\Http\Resources\Account\AccountResource;
use App\Models\Trades\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    protected $table = 'accounts';
    protected $guarded = [];

    use HasFactory;
    use Filterable;


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
}
