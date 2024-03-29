<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drink extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'drink';
    protected $fillable = [
        'drink_type_id',
        'name',
        'image',
        'price',
        'ingredient',
        'description'
    ];
}
