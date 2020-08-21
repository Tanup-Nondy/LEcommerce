<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    
    public function show($id)
    {
        $categories=Category::findOrFail($id);
        if(!is_null($categories)){
            return view('front.categories',compact('categories'));
        }
        else{
            return redirect()->route('index')->with('error','Sorry there is no category!!');
        }
    }

    
}
