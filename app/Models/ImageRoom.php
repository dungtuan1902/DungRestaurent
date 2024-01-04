<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageRoom extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'image_rooms';
    protected $fillable = [
        'room_id',
        'image'
    ];

}
