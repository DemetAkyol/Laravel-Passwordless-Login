<?php


namespace App\Auth\Traits;

use App\Mail\MagicLoginRequested;
use App\MModels\UserLoginToken;
use Mailgun\Mailgun;

trait MagicallyAuthenticatable
{

    public function storeToken()
    {
        $this->token()->delete();
        $this->token()->create([

            'token' => str_random(255)
        ]);

        return $this;
    }

    public function token()
    {

        return $this->hasOne(UserLoginToken::class);

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
    public function sendMagicLink(array $options)
    {

     $msg=new MagicLoginRequested($this,$options);
     $link=$msg->buildLink();
     $toMail=$msg->user->email;
        $mg = Mailgun::create('');
        $mg->messages()->send('sandboxxxxxxxxxxxxx.mailgun.org', [
            'from' => 'dmt.akyol@hotmail.com',
            'to' => $toMail,
            'subject' => 'Your Link To Login!',
            'text' => $link,
        ]);

    }


}