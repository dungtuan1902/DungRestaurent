<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rooms';
    protected $fillable = [
        'room_type_id',
        'name',
        'number_floor',
        'image',
        'description',
        'status'
    ];
}
