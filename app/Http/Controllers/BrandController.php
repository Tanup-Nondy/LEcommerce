<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Image;
use File;
class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$brands=Brand::orderBy('id','desc')->get();
    	return view('brand.index',compact('brands'));
    }
    public function create()
    {
    	return view('brand.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'image'=>'nullable|image|mimes:png,jpg,jpeg|max:10000'
            ],
            [
                'title.required'=>'Please provide a title for brand',
            ]
        );
        $brand=new Brand;
        $brand->name=$request->name;
        $brand->description=$request->description;        
        if($request->image){
            $image=$request->image;
            $imn=time().'.' .$image->getClientOriginalExtension();
            $lo_brandion='images/brands/' .$imn;
            Image::make($image)->save($lo_brandion);
            $brand->image=$imn;
        }
        $brand->save();
        return back()->with('success','A new Brand has been added successfully !!');
    }
    public function edit($id){
        $brand=Brand::findOrFail($id);
        return view('brand.edit',compact('brand'));
    }
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'image'=>'nullable|image|mimes:png,jpg,jpeg|max:10000'
            ],
            [
                'title.required'=>'Please provide a title for category',
            ]
        );
        $brand=Brand::findOrFail($id);
        $brand->name=$request->name;
        $brand->description=$request->description;        
        if($request->image){
            if(File::exists('images/brands/'.$brand->image)){
                File::delete('images/brands/'.$brand->image);
            }
            $image=$request->image;
            $imn=time().'.' .$image->getClientOriginalExtension();
            $location='images/brands/' .$imn;
            Image::make($image)->save($location);
            $brand->image=$imn;
        }
        $brand->save();
        return redirect()->route('admin.brand')->with('success','Brand has been updated successfully !!');
    }
    public function delete($id){
        $brand=Brand::findOrFail($id);
        if(!is_null($brand)){
            if(File::exists('images/brands/'.$brand->image)){
                File::delete('images/brands/'.$brand->image);
            }
            $brand->delete();
        }
        return redirect()->route('admin.brand')->with('success','Brand has been deleted successfully !!');
    }
}
