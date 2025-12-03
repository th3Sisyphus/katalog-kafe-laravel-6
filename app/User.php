<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_user';
    protected $table='users';

    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'photo'
    ];

    protected $hidden = [
        'password', 
    ];

    protected $casts = [
        
    ];
}
