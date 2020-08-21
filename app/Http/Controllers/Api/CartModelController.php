<?php

namespace App\Http\Controllers\Api;

use App\CartModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartModelController extends Controller
{
    public function index()
    {
    	return view('cart.index');
    }
    public function update(Request $request,$id)
    {
    	$cart=CartModel::find($id);
    	if(!is_null($cart)){
    		$cart->pro_qty=$request->qty;
    		$cart->save();
    	}else{
    		return redirect()->back();
    	}
    	return redirect()->back();
    }
    public function delete($id)
    {
    	$cart=CartModel::find($id);
    	if(!is_null($cart)){
    		$cart->delete();
    	}else{
    		return redirect()->back();
    	}
    	return redirect()->back();
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'product_id'=>'required'
    	],
    	[
    		'product_id.required'=>'Please add a product first!!'
    	]
    	);
    	if(Auth::check()){
    		$cart_previous=CartModel::where('user_id',Auth::id())
            ->where('order_id',null)
            ->where('product_id',$request->product_id)->first();
    	}else{
    		$cart_previous=CartModel::where('ip_address',request()->ip())
            ->where('order_id',null)
            ->where('product_id',$request->product_id)->first();
    	}
    	
    	if(!is_null($cart_previous)){
    		$cart_previous->increment('pro_qty');
    		$cart_previous->save();
    	}
    	else{
    		$cart =new CartModel();
	    	if(Auth::check()){
	    		$cart->user_id=Auth::id();
	    	}
	    	$cart->ip_address=request()->ip();
	    	$cart->product_id=$request->product_id;
	    	$cart->save();
    	}
    	
    	return json_encode(['status'=>'success','Message'=>'Item added to cart','totalItems'=>CartModel::total_items()]);
    }
}
