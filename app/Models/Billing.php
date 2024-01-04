<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use HasFactory, SoftDeletes;
    					
    protected $table = 'billing';
    protected $fillable = [
        'booking_id',
        'payment_date',
        'payment_method',
        'total',
        'promotion',
        'status'
    ];
}
