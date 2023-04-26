<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
