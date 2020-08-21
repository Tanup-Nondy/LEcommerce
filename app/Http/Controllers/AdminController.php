<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use File;
use Symfony\Component\Console\Input\Input;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
    	return view('admin.index');
    }
    public function create(){
    	return view('product.create');
    }
    public function edit($id){
    	$product=Product::findOrFail($id);
    	return view('product.edit',compact('product'));
    }
    public function products(){
    	$products=Product::orderBy('id','desc')->get();
    	return view('product.manage_product',compact('products'));
    }
    public function store(Request $request){

    	//$formInput=$request->except('image');
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'brand_id'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'status'=>'required',
            'oprice'=>'required',
            'image.*'=>'image|mimes:png,jpg,jpeg|max:10000'
        ]);
        $product=new Product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->status=$request->status;
        $product->offer_price=$request->oprice;
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->slug=Str::slug($request->title);
        $product->admin_id=1;

        $product->save();
        $c=0;
    	if(count($request->image)>0){
    		foreach($request->image as $image){
    			$c++;
    			$imn=time(). $c. '.' .$image->getClientOriginalExtension();
    		$location='images/products/' .$imn;
    		Image::make($image)->save($location);

    		$product_image=new ProductImage;
    		$product_image->product_id=$product->id;
    		$product_image->image=$imn;	
    		$product_image->save();
    		}
    	}

    		
    	return redirect()->route('admin.products.create');
    }
    public function update(Request $request, $id){

    	//$formInput=$request->except('image');
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'brand_id'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'status'=>'required',
            'oprice'=>'required',
            'image.*'=>'image|mimes:png,jpg,jpeg|max:10000'
        ]);
        $product=Product::findOrFail($id);
        $product->title=$request->title;
        $product->description=$request->description;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->status=$request->status;
        $product->offer_price=$request->oprice;
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->slug=Str::slug($request->title);
        $product->admin_id=1;
        $product->save();
        $c=0;
    	if($request->image){
    		foreach($request->image as $image){
    			$c++;
    			$imn=time(). $c. '.' .$image->getClientOriginalExtension();
    		$location='images/products/' .$imn;
    		Image::make($image)->save($location);

    		$product_image=new ProductImage;
    		$product_image->product_id=$product->id;
    		$product_image->image=$imn;	
    		$product_image->save();
    		}
    	}

    		
    	return redirect()->route('admin.products');
    }
    public function delete($id){
        $product=Product::findOrFail($id);
        if(!is_null($product)){
            $pro_img=ProductImage::where('product_id',$id)->get();
            foreach ($pro_img as $img) {
                    if(File::exists('images/products/'.$img->image)){
                        File::delete('images/products/'.$img->image);
                    }
                $img->delete();
            }
            $product->delete();
        }
        
        return back()->with('success','Product has deleted successfully !!');
    }

}
