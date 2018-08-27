<?php


namespace App\Auth\Traits;

use App\Mail\MagicLoginRequested;
use App\Models\UserLoginToken;
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

        // bu mailde çalışıyodu
        return url('/login/magic/' . $this->user->token->token . '?' . http_build_query($this->options));
    }
    public function sendMagicLink(array $options)
    {

     $asd=new MagicLoginRequested($this,$options);
     $link=$asd->buildLink();
        $mg = Mailgun::create('daadee9d1a9069a4cda67f4cac48681f-7efe8d73-fd45db81');
        $mg->messages()->send('sandbox3f40fe311c8945778eb707440992b228.mailgun.org', [
            'from' => 'demet.akyol44@gmail.com',
            'to' => 'demet.akyol44@gmail.com',
            'subject' => 'Your Link To Login!',
            'text' => $link,
        ]);


        //\Mail::to($this)->send(new MagicLoginRequested($this,$options));
    }


}