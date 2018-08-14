<?php

namespace App\Http\Controllers\Auth;

use App\Auth\SmsAuthentication;
use App\Http\Controllers\Controller;
use App\UserLoginCode;
use Auth;
use Illuminate\Http\Request;

class SmsLoginController extends Controller
{

public  function show(){


    return view('auth.magic.smsLogin');



}
    public function sendCode(Request $request, MagicAuthentication $auth)
    {
        $this->validateLogin($request);
       //$auth->requestlink();

    }

    public function validateLogin(Request $request)
    {

        $this->validate($request, [

            'phone' => 'required|exists:users,phone'


        ]);


    }
/*
    public function validateToken(Request $request, UserLoginToken $token)
    {

        $token->delete();
        Auth::login($token->user, $request->remember);
        return redirect()->intended();      //intended: back to their intended destination after the login


    }

*/









}

