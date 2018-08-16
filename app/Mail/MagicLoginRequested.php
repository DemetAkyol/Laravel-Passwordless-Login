<?php

namespace App\Mail;

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
class MagicLoginRequested extends Mailable
{
    use Queueable, SerializesModels;

       public $user;
       public $options;

    public function __construct(User $user,array $options)
    {
        $this->user=$user;
        $this->options=$options;
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
    public function buildCode(){



    return $this->user->tokenCode()->LoginCode;


    }

}
