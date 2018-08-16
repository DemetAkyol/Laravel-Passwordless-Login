<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class UserLoginCode extends Model
{
    const EXPIRATION_TIME = 15; // minutes
    //suse Traits\SmsAuthenticatable;

    protected $table = 'users_login_codes';
    protected $fillable = [
        'LoginCode',
        'used',
        'user_id'

    ];


    public function user()
    {
        return $this->belongsTo(User::class);

    }


    public function isValid()
    {
        return ! $this->isUsed() && ! $this->isExpired();
    }

    public function isUsed()
    {
        return $this->used;
    }


    public function isExpired()
    {
        return $this->created_at->diffInMinutes(\Carbon\Carbon::now()) > static::EXPIRATION_TIME;
    }


}
