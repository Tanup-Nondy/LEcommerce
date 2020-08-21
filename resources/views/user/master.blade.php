@extends('front.master')

@section('content')
	<div class="container mt-2" >
		<div class="row">
			<div class="col-md-4">
				<div class="list-group">
					<a href="" class="list-group-item">
						<img src="{{App\Helpers\ImageHelper::getUserImage(Auth::user()->id)}}" class="img rounded-circle" style="width:100px;"alt="">
					</a>
					<a href="{{route('user.dashboard')}}" class="list-group-item {{Route::is('user.dashboard') ? 'active' : ''}}">Dashboard</a>
					<a href="{{route('user.edit')}}" class="list-group-item {{Route::is('user.edit') ? 'active' : ''}}">Update Profile</a>	
					<a href="{{route('user.edit_password')}}" class="list-group-item {{Route::is('user.edit_password') ? 'active' : ''}}">Update Password</a>	
				</div>
			</div>
			<div class="col-md-8">
				<div class="card card-body">		
				@yield('sub_content')
				</div>
			</div>
		</div>
	</div>
@endsection