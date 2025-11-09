<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'User_ID';

    public $timestamps= false;

    protected $fillable = [
        'user_id',
        'Name',
        'username',
        'email',
        'password',
        'Role',
    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];
    
}
