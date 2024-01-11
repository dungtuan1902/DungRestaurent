<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrinkType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'drink_type';
    protected $fillable = [
        'name',
        'image'
    ];
}
