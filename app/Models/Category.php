<?php

namespace App\Models;

use App\Models\Trades\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];
    use HasFactory;
    public function accounts(){
        return $this->hasMany(Account::Class,'category_id', 'id');
    }
}
