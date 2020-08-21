<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Image;
use File;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$categories=Category::orderBy('id','desc')->get();
    	return view('category.index',compact('categories'));
    }
    public function create()
    {
    	$parent_cat=Category::orderBy('name','desc')->where('parent_id',NULL)->get();
    	return view('category.create',compact('parent_cat'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'image'=>'nullable|image|mimes:png,jpg,jpeg|max:10000'
            ],
            [
                'title.required'=>'Please provide a title for category',
            ]
        );
        $cat=new Category;
        $cat->name=$request->name;
        $cat->description=$request->description;
        $cat->parent_id=$request->parent_id;
        
        if($request->image){
            $image=$request->image;
            $imn=time().'.' .$image->getClientOriginalExtension();
            $location='images/categories/' .$imn;
            Image::make($image)->save($location);
            $cat->image=$imn;
        }
        $cat->save();
        return back()->with('success','A new Category has been added successfully !!');
    }
    public function edit($id){
        $category=Category::findOrFail($id);
        $parent_cat=Category::orderBy('name','desc')->where('parent_id',NULL)->get();
        //dd($category);
        return view('category.edit',compact('category','parent_cat'));
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
        $cat=Category::findOrFail($id);
        $cat->name=$request->name;
        $cat->description=$request->description;
        $cat->parent_id=$request->parent_id;
        
        if($request->image){
            if(File::exists('images/categories/'.$cat->image)){
                File::delete('images/categories/'.$cat->image);
            }
            $image=$request->image;
            $imn=time().'.' .$image->getClientOriginalExtension();
            $location='images/categories/' .$imn;
            Image::make($image)->save($location);
            $cat->image=$imn;
        }
        $cat->save();
        return redirect()->route('admin.categories')->with('success','Category has been updated successfully !!');
    }
    public function delete($id){
        $cat=Category::findOrFail($id);
        if(!is_null($cat)){
            //if parent cat then delete sub cats also
            if($cat->parent_id==NULL){
            $sub_cat=Category::orderBy('name','desc')->where('parent_id',$cat->id)->get();
            foreach ($sub_cat as $sub) {
                    if(File::exists('images/categories/'.$sub->image)){
                        File::delete('images/categories/'.$sub->image);
                    }
                $sub->delete();
                }
            }
            if(File::exists('images/categories/'.$cat->image)){
                File::delete('images/categories/'.$cat->image);
            }
            $cat->delete();
        }
        return redirect()->route('admin.categories')->with('success','Category has been deleted successfully !!');
    }
}
