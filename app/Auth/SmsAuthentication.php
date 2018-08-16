<?php

namespace App\Auth;

use App\Http\Requests;
use App\User;
use App\UserLoginCode;
use Illuminate\Http\Request;


class SmsAuthentication
{


    protected $request;
    protected $identifier = 'phone';
    protected $identifierCode = 'LoginCode';
    public function __construct(Request $request)
    {


        $this->request = $request;


    }

    public function sendLoginCode()
    {


       $user = $this->getUserByIdentifier($this->request->get($this->identifier));

           $token = UserLoginCode::create([
               'user_id' => $user->id
           ]);




      $user->storeCode()->sendVerfCode([

            'phone' => $user->phone,


        ]);

       session()->put("token_id", $token->id);
       session()->put("user_id", $user->id);


       //$data=session()->get('token_id');
      // dd($data);



    }




    public function getUserByIdentifier($value)
    {
        return User::where($this->identifier, $value)->firstOrFail();
    }





    public function getCodeWithIdentifier($value)
    {


        return UserLoginCode::where($this->identifierCode, $value)->firstOrFail();

    }



}