<?php

namespace App;

use App\CartModel;
use App\OrderModel;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CartModel extends Model
{
    public $fillable=[
    	'user_id',
    	'product_id',
    	'order_id',
    	'ip_address',
    	'pro_qty'
    ];
    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function order(){
    	return $this->belongsTo(OrderModel::class);
    }
    public function product(){
    	return $this->belongsTo(Product::class);
    }
    public static function total_items(){
        $carts=CartModel::total_carts();
        $total_qty=0;
        foreach($carts as $cart){
            $total_qty+=$cart->pro_qty;
        }
        return $total_qty;
    }
    public static function total_carts(){
        if(Auth::check()){
            $carts=CartModel::where('user_id',Auth::id())
            ->orwhere('ip_address',request()->ip())
            ->where('order_id',null)->get();
        }else{
            $carts=CartModel::where('ip_address',request()->ip())->where('order_id',null)->get();
        }
        
        return $carts;
    }
}
