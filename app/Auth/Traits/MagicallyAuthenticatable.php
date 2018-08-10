<?php


namespace App\Auth\Traits;

use App\Mail\Mailer;

use App\Mail\MagicLoginRequested;
use App\UserLoginToken;

trait MagicallyAuthenticatable{

public function token(){

    return $this->hasOne(UserLoginToken::class);

}

 public function storeToken(){

    $this->token()->delete();
    $this->token()->create([

    'token' =>str_random(255)
]);

   return $this;
 }



 public function sendMagicLink(array $options){

     \Mail::to($this)->send(new MagicLoginRequested($this,$options));


 }

}