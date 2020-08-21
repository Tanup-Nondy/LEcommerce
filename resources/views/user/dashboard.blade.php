@extends('user.master')
@section('sub_content')
<!-- start sidebar -->
<div class="container mb-5">
	@if(session('success'))
					<div class="alert alert-info">
						
							<p>{{session('success')}}</p>
						
					</div>
					@endif	
	<h3>Welcome {{$user->f_name.' '.$user->l_name}}</h3>
	<div class="row">
		<div class="col-md-6">
				<div class="list-group">
					<a class="list-group-item">First Name : {{$user->f_name}}</a>
					<a class="list-group-item">Last Name : {{$user->l_name}}</a>
					<a class="list-group-item">User Name : {{$user->username}}</a>
					<a class="list-group-item">Phone No : {{$user->phone}}</a>
					<a class="list-group-item">Email : {{$user->email}}</a>
				</div>
		</div>
		<div class="col-md-6">
				<div class="list-group">
					<a class="list-group-item">Street Address : {{$user->street}}</a>
					<a class="list-group-item">Division Name : {{$div->name}}</a>
					<a class="list-group-item">District Name : {{$dis->name}}</a>
					<a class="list-group-item">Shipping Address : {{$user->shipping_address}}</a>
				</div>
		</div>
	</div>
	
</div>
<!-- End sidebar-->
@endsection