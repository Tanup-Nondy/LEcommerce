<?php

namespace App\Http\Controllers;

use App\Districts;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$districts=Districts::orderBy('name','asc')->get();

    	//dd($districts);
        return view('admin.districts.index',compact('districts'));
    }
    public function create()
    {
    	return view('admin.districts.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'division_id'=>'required',
            ],
            [
                'title.required'=>'Please provide a title for district',
                'division_id.required'=>'Please provide a division id',
            ]
        );
        $district=new Districts;
        $district->name=$request->name;
        $district->division_id=$request->division_id;        
        $district->save();
        return redirect()->route('admin.districts')->with('success','A new District has been added successfully !!');
    }
    public function edit($id){
        $district=Districts::findOrFail($id);
        return view('admin.districts.edit',compact('district'));
    }
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name'=>'required',
            'priority'=>'required',
            ],
            [
                'title.required'=>'Please provide a title for district',
                'division_id.required'=>'Please provide a division id',
            ]
        );
        $district=Districts::findOrFail($id);
        $district->name=$request->name;
        $district->division_id=$request->division_id;        
        $district->save();
        return redirect()->route('admin.districts')->with('success','District has been updated successfully !!');
        
        
    }
    public function delete($id){
        $district=Districts::findOrFail($id);
        if(!is_null($district)){
            
            $district->delete();
        }
        return redirect()->route('admin.districts')->with('success','District has been deleted successfully !!');
    }
}
