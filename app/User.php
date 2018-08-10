<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Auth\Traits\MagicallyAuthenticatable;

class User extends Authenticatable
{
    use Notifiable,MagicallyAuthenticatable;


    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
}
