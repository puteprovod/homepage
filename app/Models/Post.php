<?php

namespace App\Models;

use App\Models\Trades\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $guarded = [];
    use Filterable;

    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
