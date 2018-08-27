<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserLoginToken
 *
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLoginToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLoginToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLoginToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLoginToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLoginToken whereUserId($value)
 */
class UserLoginToken extends Model
{
    /**
     * @return User
     */


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
