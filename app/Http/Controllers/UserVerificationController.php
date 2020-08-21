<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    public function verify($token){
    	$user=User::where('remember_token',$token)->first();
    	if(!is_null($user)){
    		$user->status=1;
    		$user->remember_token=null;
    		$user->save();
    		return back()->with('success','Welcome you have successfully registered. Login now..!');
    	}
    	else{
    		return redirect('register')->with('success','Sorry your token does not match. Please register again!');
    	}
    }
}