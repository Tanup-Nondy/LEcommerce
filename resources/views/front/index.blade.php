@extends('front.master')
@section('content')

<!-- Slider-->

		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			  <ol class="carousel-indicators">
			  	@foreach($images as $image)
			    <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="{{$loop->index == 0 ? 'active' : ''}}"></li>
			    @endforeach
			  </ol>
			  <div class="carousel-inner">
			  	@foreach($images as $image)
			    <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
			      <img src="{{asset('images/sliders/'.$image->image)}}" class="d-block w-100" alt="{{$image->title}}" style="height:450px; width:900px;"/>
			      <div class="carousel-caption d-none d-md-block">
		          <h5>{{$image->title}}</h5>
		          @if($image->button_text)
		          	<p>
		          		<a href="{{$image->button_link}}" target="_blank" class="btn btn-danger">{{$image->button_text}}</a>
		          	</p>
		          @endif
		        </div>
			    </div>
			    @endforeach
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
<!-- start sidebar -->
<div class="container margin-top-20">
	@if(session('success'))
		<div class="alert alert-info">			
			<p>{{session('success')}}</p>			
		</div>
	@endif
	
	<div class="row">
		@include('front.sidebar')
		<div class="col-md-8">
			<div class="widget">
				<h3>All Products</h3>
				@include('partials.all_products')
			</div>
		</div>
	</div>
</div>

<!-- End sidebar-->
@endsection