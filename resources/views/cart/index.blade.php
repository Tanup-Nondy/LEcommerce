@extends('front.master')
@section('content')
<!-- start sidebar -->
<div class="container margin-top-20">
	@if(App\CartModel::total_items() >0)
		<h2>My Cart Items</h2>
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
			@foreach(App\CartModel::total_carts() as $cart)
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
	<div class="float-right">
		<a href="{{route('products')}}"class="btn btn-info btn-lg">Continue Shopping!</a>
		<a href="{{route('checkouts')}}"class="btn btn-warning btn-lg">Checkout</a>
	</div>
	<div class="clearfix"></div>
	@else
		<div class="alert alert-info">
			<strong>You currently have no items in the cart</strong>
			<br>
			<a href="{{route('products')}}"class="btn btn-info btn-lg">Continue Shopping!</a>
		</div>
	@endif
</div>

<!-- End sidebar-->
@endsection