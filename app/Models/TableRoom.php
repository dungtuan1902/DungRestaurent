<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TableRoom extends Model
{
    use HasFactory,SoftDeletes;
    		
    protected $table = 'table_room';
    protected $fillable = [
        'room_id',
        'number_table',
        'quantity_people'
    ];
}
