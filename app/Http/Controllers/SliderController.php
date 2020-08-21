<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Image;
use File;
class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$sliders=Slider::orderBy('priority','asc')->get();
    	//dd($slider);
        return view('admin.slider.index',compact('sliders'));
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'image'=>'required|image',
            'priority'=>'required',
            'button_link'=>'nullable|url',
            'button_text'=>'nullable',
            ],
            [
                'title.required'=>'Please provide a title for slider',
                'image.required'=>'Please provide image for slider',
                'image.image'=>'Please provide valid image for slider',
                'priority.required'=>'Please provide a title for slider',
                'button_link.url'=>'Please provide a valid button_link for slider',
            ]
        );
        $slider=new Slider;
        $slider->title=$request->title;
        $slider->priority=$request->priority;  
        $slider->button_link=$request->button_link;  
        $slider->button_text=$request->button_text;  
        if($request->image){
            $image=$request->image;
            $imn=time().'.' .$image->getClientOriginalExtension();
            $location='images/sliders/' .$imn;
            Image::make($image)->save($location);
            $slider->image=$imn;
        }      
        $slider->save();
        return redirect()->route('admin.slider')->with('success','A new slider has been added successfully !!');
    }
    
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'title'=>'required',
            'image'=>'required|image',
            'priority'=>'required',
            'button_link'=>'nullable|url',
            'button_text'=>'nullable',
            ],
            [
                'title.required'=>'Please provide a title for slider',
                'image.required'=>'Please provide image for slider',
                'image.image'=>'Please provide valid image for slider',
                'priority.required'=>'Please provide a title for slider',
                'button_link.url'=>'Please provide a valid button_link for slider',
            ]
        );
        $slider=Slider::findOrFail($id);
        $slider->title=$request->title;
        $slider->priority=$request->priority;  
        $slider->button_link=$request->button_link;  
        $slider->button_text=$request->button_text; 
        if($request->image){
            if(File::exists('images/sliders/'.$slider->image)){
                File::delete('images/sliders/'.$slider->image);
            }
            $image=$request->image;
            $imn=time().'.' .$image->getClientOriginalExtension();
            $location='images/sliders/' .$imn;
            Image::make($image)->save($location);
            $slider->image=$imn;
        }       
        $slider->save();
        return redirect()->route('admin.slider')->with('success','slider has been updated successfully !!');
        
        
    }
    public function delete($id){
        $slider=Slider::findOrFail($id);
        if(!is_null($slider)){
            if(File::exists('images/sliders/'.$slider->image)){
                File::delete('images/sliders/'.$slider->image);
            }
            $slider->delete();
        }
        return redirect()->route('admin.slider')->with('success','District has been deleted successfully !!');
    }
}
