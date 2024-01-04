<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenaltyBilling extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penalty_billing';
    protected $fillable = [
        'penalty_id',
        'billing_id',
        'quantity_time'
    ];
}
