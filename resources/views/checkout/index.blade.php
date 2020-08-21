@extends('front.master')
@section('content')
<!-- start sidebar -->
<div class="container margin-top-20">
	<div class="card card-body">
		<h2>Confirm Items</h2>
		<hr>
		<div class="row">
			<div class="col-md-7 border-right">
				@foreach(App\CartModel::total_carts() as $cart)
					<p>
					{{$cart->product->title}} -
					<strong>{{$cart->product->price}}$</strong> -
					{{$cart->pro_qty}} item(s)
					</p>
				@endforeach
			</div>
			<div class="col-md-5">
				<?php $total=0;?>
				@foreach(App\CartModel::total_carts() as $cart)
					<?php $total+=$cart->product->price*$cart->pro_qty;?>
				@endforeach
				<?php $ship=App\Setting::first()->shipping_cost;?>
				<p>Total Price: <strong>{{$total}}$</strong></p>
				<p>Shipping Cost: <strong>{{$ship}}$</strong></p>
				<p>Total Price with Shipping Cost: <strong>{{$total+$ship}}$</strong></p>
			</div>
		</div>
		
			<a class="btn btn-info btn-lg float-left" href="{{route('carts')}}"> Change Cart Items!</a>
				
	</div>
	<div class="card card-body mt-2">
		<h2>Shipping Address</h2>
		<form method="POST" action="{{ route('checkouts.store') }}">
                        @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Receiver Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::check() ?  Auth::user()->f_name.' '.Auth::user()->l_name :''}}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong></span>
                    @enderror
                    </div>
            </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::check() ?  Auth::user()->email :'' }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ Auth::check() ?  Auth::user()->phone :''  }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_address" class="col-md-4 col-form-label text-md-right">Shipping Address</label>

                            <div class="col-md-6">
                                <input id="shipping_address" type="text" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" value="{{ Auth::check() ?  Auth::user()->shipping_address :''  }}" required autocomplete="shipping_address" autofocus>

                                @error('shipping_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
        <div class="form-group row">
        <label for="payment_method" class="col-md-4 col-form-label text-md-right">Payment Method</label>

        <div class="col-md-6">
        <select class="form-control" name="payment_method" required id="payments">
            <option value="">Please select a payment method</option>}
            @foreach(App\Payment::orderBy('priority','asc')->get() as $method)
                <option value="{{$method->short_name}}">{{$method->name}}</option>}
            @endforeach
        </select>
        @foreach(App\Payment::orderBy('priority','asc')->get() as $method)
                @if($method->short_name =="cash_on_del")
                    <div class="hidden alert alert-success" id="{{$method->short_name}}">
                        <h3>For cash on delivery nothing is require. Just click to order now!! </h3>
                        <small>You will get your product within two or three business days !!</small>
                    </div>
                @else
                    <div class="hidden alert alert-success" id="{{$method->short_name}}">
                    	<h3>{{$method->name}} Payment</h3>
                        <p><strong>{{$method->name}} No: {{$method->number}}</strong>
                        <br>
                        <strong>Account type: {{$method->type}}</strong>
                    	</p>
                    	<div class="alert alert-success">
                    		Please send the money to this Number and write your transaction code below there.
                    	</div>
                        
                    </div>
                @endif
           
            @endforeach
            <input class="hidden" name="transaction_id" type="text" id="transaction_id" placeholder="Please enter the transaction code here" />
            @error('payment_method')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong></span>
            @enderror
            </div>
        </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Order Now') }}
                    </button>
                </div>
            </div>
            </form>
	</div>		
</div>

<!-- End sidebar-->
@endsection
@section('scripts')
    <script type="text/javascript">
        $("#payments").change(function(){
            $method_val=$("#payments").val();
            if($method_val=='cash_on_del'){
            	$("#cash_on_del").removeClass('hidden');
            	$("#bkash").addClass('hidden');
            	$("#rocket").addClass('hidden');
            	$("#transaction_id").addClass('hidden');
            }
            else if($method_val=='bkash'){
            	$("#bkash").removeClass('hidden');
            	$("#cash_on_del").addClass('hidden');
            	$("#rocket").addClass('hidden');
            	$("#transaction_id").removeClass('hidden');
            }
            else{
            	$("#rocket").removeClass('hidden');
            	$("#bkash").addClass('hidden');
            	$("#cash_on_del").addClass('hidden');
            	$("#transaction_id").removeClass('hidden');
            }
        })
    </script>
@endsection