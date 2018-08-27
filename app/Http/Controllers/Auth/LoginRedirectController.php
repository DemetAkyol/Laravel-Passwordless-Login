<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class LoginRedirectController extends Controller
{


    public function get_choice()
    {


        return view('choice');


    }

    public function post_choice(Request $request)
    {

        $fields = Input::get('result');
        if($fields == 'Mail'){
            return redirect('login/magic');
        }
        else{
            return redirect('login/smsLogin');
        }



    }


}
