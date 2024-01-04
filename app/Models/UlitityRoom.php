<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UlitityRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ulitity_rooms';
    protected $fillable = [
        'room_type_id',
        'name'
    ];
}
