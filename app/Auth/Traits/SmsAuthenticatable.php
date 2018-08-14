<?php


namespace App\Auth\Traits;

use Mailgun\Mailgun;
use App\Mail\MagicLoginRequested;
//use App\UserLoginToken;


trait SmsAuthenticatable
{


    public function generateCode($codeLength = 4)
    {
        $min = pow(10, $codeLength);
        $max = $min * 10 - 1;
        $code = mt_rand($min, $max);

        return $code;
    }
    public function storeToken()
    {

        $this->token()->delete();
        $this->token()->create([

            'code' => $this->generateCode(),
        ]);

        return $this;
    }

    public function token()
    {

        return $this->hasOne(UserLoginCode::class);

    }


    public function sendVerfCode(){





}



}