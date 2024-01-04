<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryBilling extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'history_billing';
    protected $fillable = [
        'billing_id',
        'admin_id',
        'handle'
    ];
    		
}
