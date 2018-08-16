<?php

namespace App\Http\Controllers\Auth;
use App\Auth\SmsAuthentication;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Auth;
use Illuminate\Http\Request;
use App\UserLoginCode;
class SmsLoginController extends Controller
{
    protected $identifier = 'user_id';
public  function show(){


    return view('auth.magic.smsLogin');

}
    public function sendCode(Request $request, SmsAuthentication $auth)
    {
        $this->validatePhone($request);
        $auth->sendLoginCode();

        //$user_id=$auth->loginHelper();
        return redirect('code');//->with($user_id);
    }

    public function codes()
    {

        return view('code');


    }


    public function controlCode(Request $request)
    { // $this->validateCode($request);


        if (!session()->has("token_id", "user_id")) {
            return redirect("login/smsLogin");
        }


        $token = UserLoginCode::where($this->identifier, session()->get("user_id"))->firstOrFail();

        if (!$token ||
            !$token->isValid() ||
            (int)$request->LoginCode !== $token->LoginCode ||
            (int)session()->get("user_id") !== $token->user->id
        ) {




            return redirect("code")->withErrors([dd('error')]);
        }

        $token->used = 1;
        $token->save();
        Auth::login($token->user, false);;


        return redirect('home');
        //return Redirect::intended;
    }


    public function validatePhone(Request $request)
    {

        $this->validate($request, [

            'phone' => 'required|exists:users,phone'


        ]);


    }


    public function validateCode(Request $request)
    {

        $this->validate($request, [

            'LoginCode' => 'required|exists:users_login_codes,LoginCode'


        ]);


    }








}

