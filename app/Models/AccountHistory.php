<?php

namespace App\Models;

use App\Models\Trades\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHistory extends Model
{
    protected $table = 'account_histories';
    protected $guarded = [];
    use HasFactory;

    use Filterable;
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
