<?php

namespace App\Http\Controllers;

use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
    	$products=Product::orderBy('id','desc')->paginate(9);//shows paginate for more than 9 products
        $images=Slider::orderBy('priority','asc')->get();
    	return view('front.index',compact('products','images'));
    }
    public function products(){
    	$products=Product::orderBy('id','desc')->paginate(9);
    	//dd($products);
    	return view('product.index',compact('products'));
    }
    public function show($slug)
    {
    	$product=Product::where('slug',$slug)->first();
    	if(!is_null($product)){
    		return view('product.show',compact('product'));
    	}
    	else{
    		return back()->with('msg','No product is found!');
    	}
    }
    public function search(Request $request)
    {
    	$search=$request->search;
    	$products=Product::orwhere('title','like','%'.$search.'%')
    	->orwhere('description','like','%'.$search.'%')
    	->orwhere('price','like','%'.$search.'%')
    	->orderBy('id','desc')->paginate(9);
    	return view('product.search',compact('products','search'));
    }
    public function autocomplete(Request $request)
    {
        $data = Product::select("title as name")->where("title","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }
}
