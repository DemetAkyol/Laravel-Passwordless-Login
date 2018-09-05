<?php


namespace App\MModels;
use App\User;
use Illuminate\Database\Eloquent\Model;


class UserLoginToken extends Model
{


    protected $table = 'users_login_tokens';
    protected $fillable = [
        'token'
    ];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }

}
