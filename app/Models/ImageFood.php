<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageFood extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'image_foods';
    protected $fillable = [
        'food_id',
        'image'
    ];

}
