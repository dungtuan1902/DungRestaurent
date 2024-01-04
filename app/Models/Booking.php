<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'booking';
    protected $fillable = [
        'name',
        'phone',
        'user_id',
        'quantity_people',
        'checkin',
        'hours',
        'status'
    ];
}
