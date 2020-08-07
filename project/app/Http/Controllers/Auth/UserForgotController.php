<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserForgotController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:user', ['except' => ['logout']]);
    }

    public function showforgotform()
    {
    	return view('user.forgot');
    }

    public function forgot(Request $request)
    {
    	$input =  $request->all();
        if (User::where('email', '=', $request->email)->count() > 0) {
            // user found
            $user = User::where('email', '=', $request->email)->firstOrFail();
            $autopass = str_random(8);
            $input['password'] = Hash::make($autopass);

            $user->update($input);
            $subject = "Reset Password Request";
            $msg = "Your New Password is : ".$autopass;
            mail($request->email,$subject,$msg);
            Session::flash('success', 'Your Password Reseted Successfully. Please Check your email for new Password.');
    		return redirect()->route('user-forgot');

        }
        else{
            // user not found
            Session::flash('unsuccess', 'No Account Found With This Email.');
    		return redirect()->route('user-forgot');
        }



    }
}
