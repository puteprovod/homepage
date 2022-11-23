<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResizedImage extends Model
{
    protected $table = 'resized_images';
    protected $guarded = [];
    use HasFactory;
}
