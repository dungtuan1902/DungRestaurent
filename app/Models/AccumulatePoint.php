<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccumulatePoint extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'accumulate_point';
   			
    protected $fillable = [
        'user_id',
        'point',
        'status'
    ];
}
