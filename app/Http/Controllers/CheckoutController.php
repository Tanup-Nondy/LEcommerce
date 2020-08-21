<?php

namespace App\Http\Controllers;

use App\CartModel;
use App\OrderModel;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
    	return view('checkout.index');
    }
    
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'name'=>'required',
            'phone'=>'required|min:11|max:15',
            'shipping_address'=>'required|string',
            'payment_method'=>'required'
            
    	],
    	[
    		'name.required'=>'Please provide name',
            'phone.required'=>'Please provide phone number',
            'shipping_address.required'=>'Please provide shipping address',
            'payment_method.required'=>'Please select a peyment method'
    	]
    	);
        if($request->payment_method !='cash_on_del'){
            if($request->transaction_id ==null || empty($request->transaction_id)){
                return back()->with('error','Please provide a transaction id');
            }
        }
        $payment_id=Payment::where('short_name',$request->payment_method)->first()->id;
        $order=new OrderModel();
        $order->name=$request->name;
        $order->email=$request->email;
        $order->phone=$request->phone;
        $order->shipping_address=$request->shipping_address;
        $order->message=$request->message;
        $order->ip_address=request()->ip();
        $order->payment_id=$payment_id;
        $order->transaction_id=$request->transaction_id;
        
        
    	if(Auth::check()){
    		$order->user_id=Auth::id();
    	}
	    	
    	$order->save();
        foreach(CartModel::total_carts() as $cart){
            $cart->order_id=$order->id;
            $cart->save();
        }
    	return redirect()->route('front.index')->with('success','Your order has been taken successfully !!! Please wait for the admin to respond!!!'); 
    }
}
