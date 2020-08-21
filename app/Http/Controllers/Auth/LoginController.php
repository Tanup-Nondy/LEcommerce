<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\VerifyUserRegistration;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user=User::where('email',$request->email)->first();
        if($user->status==1){
            if(Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
                return redirect()->intended(route('front.index'));
            }
        }
        else{
            if(!is_null($user)){
                $user->notify(new VerifyUserRegistration($user));
                return redirect()->route('front.index')->with('success','A confirmation email has been sent to you. Please check your email to confirm..');
            }
            else{
                return redirect()->route('login')->with('success','Please login first!!');
            }
        }
    }
}
