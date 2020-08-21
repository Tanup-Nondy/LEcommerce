@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
        <div class="card-header">
          Manage Divisions
        </div>
        <div class="card-body">
          @if(session('success'))
          <div class="alert alert-info">
            
              <p>{{session('success')}}</p>
            
          </div>
          @endif
          <h3>Details of #LE{{$order->id}}</h3>
          <div class="row">
            
            <div class="col-md-6 border-right">
              <p><strong>Order's Name : </strong>{{$order->name}}</p>
              <p><strong>Order's Phone : </strong>{{$order->phone}}</p>
              <p><strong>Order's Email : </strong>{{$order->email}}</p>
              <p><strong>Order's Shipping Adrress : </strong>{{$order->shipping_address}}</p>
            </div>
            <div class="col-md-6">
              <p><strong>Order's Payment Method : </strong>{{$order->payment->name}}</p>
              <p><strong>Order's Transaction Id : </strong>{{$order->transaction_id}}</p>
            </div>
          </div>
          <?php
            $carts=App\CartModel::where('order_id',$order->id)->get();
          ?>
          @if($carts->count() >0)
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Product Image</th>
                  <th>Product Title</th>
                  <th>Product Quantity</th>
                  <th>Unit Price</th>
                  <th>Sub Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $total=0;?>
                @foreach($carts as $cart)
                <tr>
                  
                  <td>{{$loop->index + 1}}</td>
                  <td>
                    @if($cart->product->images->count() >0)
                      <img src="{{asset('images/products/'.$cart->product->images->first()->image)}}" width="50px" height="50px" alt="">
                    @else
                      <img src="{{asset('images/products/blank_image.png')}}" width="50px" height="50px" alt="">
                    @endif
                  
                  </td>
                  <td><a href="{{ route('products.show',$cart->product->slug)}}">{{$cart->product->title}}</a>
                  </td>
                  <td>
                    <form class="form-inline"action="{{route('carts.update',$cart->id)}}" method="post" >
                      @csrf
                      <input type="number" min="1" name="qty" value="{{$cart->pro_qty}}" class="form-control">
                      <button type="submit" class="btn btn-success ml-1">Update</button>  
                    </form>
                  </td>
                  <td>{{$cart->product->price}}$</td>
                  <td>
                    <?php $total+=$cart->product->price*$cart->pro_qty;?>
                    {{$cart->product->price*$cart->pro_qty}}$</td>
                  <td>
                    <form action="{{route('carts.delete',$cart->id)}}" method="post" >
                      @csrf
                      <input type="hidden" name="cart_id" class="form-control">
                      <button type="submit" class="btn btn-danger">Delete</button>  
                    </form>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="4"></td>
                  <td>Total Price</td>
                  <td colspan="2">
                    <strong>{{$total}}$</strong>
                  </td>
                </tr>
              </tbody>
            </table>
          @endif
          <hr>
          <form action="{{route('admin.orders.charge',$order->id)}}" method="post" style="display: inline;">
            @csrf
            <div class="form-group{{$errors->has('shipping_charge')? 'has-error':''}}">
                <label for="title">Shipping Charge </label>
                <input type="text" name="shipping_charge" class="form-control" value="{{$order->shipping_charge}}">
                <span class="text-danger">{{$errors->first('shipping_charge')}}</span>
              </div>
              <div class="form-group{{$errors->has('custom_discount')? 'has-error':''}}">
                <label for="title">Custom Discount </label>
                <input type="text" name="custom_discount" class="form-control" value="{{$order->custom_discount}}">
                <span class="text-danger">{{$errors->first('custom_discount')}}</span>
              </div>
              <input class="btn btn-success" value="Change" type="submit">
              <a href="{{route('admin.orders.invoice',$order->id)}}" class="ml-2 btn btn-info" target="_blank">Get Invoice</a>
          </form>
          <hr>
          <form action="{{route('admin.orders.confirm',$order->id)}}" method="post" style="display: inline;">
            @csrf
            @if($order->is_completed)
              <input class="btn btn-danger" value="Cancel Order" type="submit">
            @else
              <input class="btn btn-success" value="Confirm Order" type="submit">
            @endif
          </form>
          <form action="{{route('admin.orders.paid',$order->id)}}" method="post" style="display: inline;" >
            @csrf
            @if($order->is_paid)
              <input class="btn btn-danger" value="Cancel Payment" type="submit">
            @else
              <input class="btn btn-success" value="Confirm payment" type="submit">
            @endif
          </form>
          <a href="{{route('admin.orders')}}" class="btn btn-info btn-lg">Go to orders page</a>
        </div>
      </div>
        </div>
  </div>


@endsection