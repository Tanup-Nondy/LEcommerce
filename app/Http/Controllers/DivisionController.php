<?php

namespace App\Http\Controllers;

use App\Districts;
use App\Divisions;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$divisions=Divisions::orderBy('priority','asc')->get();
    	return view('admin.divisions.index',compact('divisions'));
    }
    public function create()
    {
    	return view('admin.divisions.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'priority'=>'required',
            ],
            [
                'title.required'=>'Please provide a title for division',
                'priority.required'=>'Please provide a division priority',
            ]
        );
        $division=new Divisions;
        $division->name=$request->name;
        $division->priority=$request->priority;        
        $division->save();
        return back()->with('success','A new Division has been added successfully !!');
    }
    public function edit($id){
        $division=Divisions::findOrFail($id);
        return view('admin.divisions.edit',compact('division'));
    }
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name'=>'required',
            'priority'=>'required',
            ],
            [
                'title.required'=>'Please provide a title for division',
                'priority.required'=>'Please provide a division priority',
            ]
        );
        $division=Divisions::findOrFail($id);
        $division->name=$request->name;
        $division->priority=$request->priority;        
        $division->save();
        return redirect()->route('admin.divisions')->with('success','Division has been updated successfully !!');
        
        
    }
    public function delete($id){
        $division=Divisions::findOrFail($id);
        if(!is_null($division)){
            $dis=Districts::where('division_id',$id)->get();
            foreach($dis as $district){
                $district->delete();
            }
            $division->delete();
        }
        return redirect()->route('admin.divisions')->with('success','Division has been deleted successfully !!');
    }
}
