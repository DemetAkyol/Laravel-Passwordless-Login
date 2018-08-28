<?php

namespace App\Http\Controllers\Auth;

use App\Auth\MagicAuthentication;
use App\Auth\SmsAuthentication;
use App\Http\Controllers\Controller;
use App\MModels\UserLoginCode;
use App\MModels\UserLoginToken;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class LoginRedirectController extends Controller
{
    protected $identifier = 'user_id';
    protected $identifier1 = 'email';
    public function get_choice()
    {


        return view('choice');


    }

    public function post_choice(Request $request,MagicAuthentication $auth, SmsAuthentication $auth1)
    {  $status="";

        $fields = Input::get('result');
        if($fields == 'Mail'){

            if($this->validateLogin($request)==true){

                $status="succes";

            }

            $auth->requestlink();
            return back()->with('status' ,$status);

        } else{

            $this->validatePhone($request);
            $auth1->sendLoginCode();
            return view('code');
        }


    }

    public function sendToken(Request $request,MagicAuthentication $auth)
    {
        $this->validateLogin($request);
        $auth->requestlink();


        return back();

    }

    public function validateLogin(Request $request)
    {

        $this->validate($request, [

           // 'email' => 'required|email|max:255|exists:users,email'
            'email' => 'required|string|email|max:255|exists:users,email',

        ]);

  return true;
    }

    public function validateToken(Request $request, UserLoginToken $token)
    {


        $token->delete();
        Auth::login($token->user, $request->remember);
        return redirect()->intended();      //intended: back to their intended destination after the login


    }

    public function sendCode(Request $request,SmsAuthentication $auth)
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
            return redirect("login/choice");
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
        \Auth::login($token->user, false);;


        return redirect('home');

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
