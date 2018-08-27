<?php

namespace App\SmsLogin;


use function GuzzleHttp\Psr7\copy_to_string;
use Illuminate\Bus\Queueable;

use App\User;
class LoginRequested
{
    use Queueable, SerializesModels;


       public $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function build()
    {
        return $this->subject('Your Magic Login Link')->view('email.auth.magic.link')->with([
            'link'=> $this->buildLink(),
        ]);
    }
    public function buildLink(){


        return url('/login/magic/' . $this->user->token->token . '?' . http_build_query($this->options));
    }
    public function buildCode() {



      return $this->user->tokenCode->LoginCode;


    }

}
