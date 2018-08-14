<?php

namespace App\Auth;

use App\User;
use Illuminate\Http\Request;


class MagicAuthentication
{

    protected $request;
    protected $identifier = 'phone';

    public function __construct(Request $request)
    {


        $this->request = $request;


    }

    public function senLoginCode(){

        $user = $this->getUserByIdentifier($this->request->get($this->identifier));
        $user->storeToken()->sendVerfCode([




        ]);






    }




    public function getUserByIdentifier($value)
    {
        return User::where($this->identifier, $value)->firstOrFail();
    }














}