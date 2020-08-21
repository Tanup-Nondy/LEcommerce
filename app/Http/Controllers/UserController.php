<?php

namespace App\Http\Controllers;

use App\Districts;
use App\Divisions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
    	$user=Auth()->user();
    	$div=Divisions::where('id',$user->division_id)->first();
    	$dis=Districts::where('id',$user->district_id)->first();
    	return view ('user.dashboard',compact('user','div','dis'));
    }
    public function profile()
    {
    	
    }
    public function edit()
    {
    	$user=Auth()->user();
    	return view ('user.update',compact('user'));
    }
    public function edit_password()
    {
    	return view ('user.update_pass');
    }
    public function update(Request $request)
    {

        $this->validate($request,[
            'first_name' => 'required|string|max:30',
            'last_name' => 'nullable|string|max:30',
            'phone' => 'required|string|max:15',
            'division_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'street' => 'required|string|max:255',
            ],
            [
                'first_name.required'=>'Please provide a first name',
                'last_name.required'=>'Please provide a last name ',
                'phone.required'=>'Please provide a phone',
                'division_id.required'=>'Please provide a title',
                'district_id.required'=>'Please provide a title',
                'street.required'=>'Please provide a street',
            ]
        );
        $user=Auth()->user();
        $user->f_name=$request->first_name;
        $user->l_name=$request->last_name;
        $user->phone=$request->phone;
        $user->division_id=$request->division_id;
        $user->district_id=$request->district_id;
        $user->street=$request->street;
       
        $user->save();
        return redirect()->route('user.dashboard')->with('success','Profile has been updated successfully !!');
    }
    public function update_password(Request $request)
    {

        $this->validate($request,[
            'old_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
            ],
            [
                'old_password.required'=>'Please provide old password',
                'password.required'=>'Please provide new password ',
            ]
        );
        $user=Auth()->user();
        if(Auth::guard('web')->attempt(['email'=>$user->email,'password'=>$request->old_password],$request->remember)){
             $user->password=Hash::make($request->password);
        	 $user->save();   
        	 return redirect()->route('user.dashboard')->with('success','Password has been updated successfully !!');
        }
        else{
        return back()->with('success','Old Password Does not match!!');
    	}
    }
}
