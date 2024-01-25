<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes;
    protected $table = 'admins';
    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'username',
        'password',
        'image',
        'role_id',
        'department_id',
        'email',
        'email_verified_at',
        'remember_token'
    ];
    public function Department(): string
    {
        return Department::find($this->department_id)->name;
    }
    public function Role(): string
    {
        return Role::find($this->role_id)->name;
    }
}
