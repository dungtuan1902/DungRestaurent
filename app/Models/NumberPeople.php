<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NumberPeople extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'number_people';
    protected $fillable = [
        'booking_id',
        'quantity_children',
        'quantity_adult'
    ];
}
