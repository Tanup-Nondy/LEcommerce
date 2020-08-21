<?php

namespace App\Http\Controllers;

use App\CartModel;
use App\OrderModel;
use PDF;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $orders=OrderModel::orderBy('id','desc')->get();
        //dd($orders);
        return view('admin.orders.index',compact('orders'));
    }


    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=OrderModel::find($id);
        $order->is_seen_by_admin=1;
            $order->save();
        return view('admin.orders.show',compact('order'));
    }
    public function confirm($id)
    {
        $order=OrderModel::find($id);
        if($order->is_completed)
        {
            $order->is_completed=0;
            $order->save();
            return back()->with('success','Order have been successfully confirmed!!!');
        }else{
            $order->is_completed=1;
            $order->save();
            return back()->with('success','Order have been successfully unconfirmed!!!');
        }
        
    }
    public function charge(Request $request,$id)
    {
        $order=OrderModel::find($id);
        $order->shipping_charge=$request->shipping_charge;
        $order->custom_discount=$request->custom_discount;
        $order->save();
        return back()->with('success','Shipping charge has been successfully unconfirmed!!!');
        
    }
    public function invoice($id)
    {
        $order=OrderModel::find($id);
        //return view('admin.orders.invoice', compact('order'));
        $pdf = PDF::loadView('admin.orders.invoice', compact('order'));
       return $pdf->stream('invoice.pdf'); 
        //return $pdf->download('invoice.pdf'); 
    }
    public function paid($id)
    {
        $order=OrderModel::find($id);
        if($order->is_paid)
        {
            $order->is_paid=0;
            $order->save();
            return back()->with('success','Order payment has been successfully confirmed!!!');
        }else{
            $order->is_paid=1;
            $order->save();
            return back()->with('success','Order payment has been successfully unconfirmed!!!');
        }
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $order=OrderModel::find($id);
        $order->delete();
        return redirect()->route('admin.orders')->with('success','Order have been successfully deleted!!!');
    }
}
