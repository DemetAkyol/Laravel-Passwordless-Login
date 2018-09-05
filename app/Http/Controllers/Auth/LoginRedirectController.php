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
    public function post_choice(Request $request, MagicAuthentication $auth, SmsAuthentication $auth1)
    {

        $fields = Input::get('result');
        if($fields == 'Mail'){

            if ($this->validateLogin($request)==true) {

                $status = " Your email address could not be verified ";

            }
            else{
                $status = "Your email address has been verified and we sent you a login code.";

                $auth->requestlink();
            }

            return back()->with('status', $status);

        } else {

            if ($this->validatePhone($request)===1){

                $auth1->sendLoginCode();

                return redirect('code');

            }else{

                $mailStatus="Your Phone number colud not be verified";
                return back()->with('mailStatus', $mailStatus);
            }

        }
    }
    public function sendToken(Request $request, MagicAuthentication $auth)
    {
        $this->validateLogin($request);
        $auth->requestlink();

        return back();

    }

    public function validateLogin(Request $request)
    {
        try{

            $this->validate($request, [

                'email' => 'required|string|max:255|exists:users,email',

            ]);
        }catch (\Exception $e){
      return "false";
        die;
    }

/*        $asd = ["email" => $request->email];

        $validatedData = Validator::make($asd, array(
            'email' => 'required|string|max:255|exists:users,email',
        ));
        try {
            $validatedData->validate();
        } catch (\Exception $e){
            var_dump($validatedData->errors());
            die;
        }*/
    }
    public function validateToken(Request $request, UserLoginToken $token)
    {
        $token->delete();
        Auth::login($token->user, $request->remember);
        return redirect()->intended();      //intended: back to their intended destination after the login
    }

    public function sendCode(Request $request, SmsAuthentication $auth)
    {
        $this->validatePhone($request);
        $auth->sendLoginCode();

        return redirect('code');
    }
    public function codes()
    {

        return view('code');

    }

    public function controlCode(Request $request)
    {

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


        try{

            $this->validate($request, [

                'phone' => 'required|string|max:13|exists:users,phone'

            ]);
        }catch (\Exception $e){
            return "false";

        }
    }
    public function validateCode(Request $request)
    {
        $this->validate($request, [

            'LoginCode' => 'required|exists:users_login_codes,LoginCode'

        ]);

    }
}