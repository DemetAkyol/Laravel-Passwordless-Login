<?php

namespace App\Auth;
use Illuminate\Http\Request;

use App\User;


class MagicAuthentication{

protected $request;
protected $identifier='email';
   public  function __construct(Request $request)
   {


     $this->request=$request;


   }
    public function requestlink(){

    $user=$this->getUserByIdentifier($this->request->get($this->identifier));

    $user->storeToken()->sendMagicLink([

        'remember'=>$this->request->has('remember'),
        'email'=>$user->email,



    ]);

     }


    public function getUserByIdentifier ($value)
    {
        return User::where($this->identifier,$value)->firstOrFail();
    }

}




