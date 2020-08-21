@extends('front.master')
@section('content')
<!-- start sidebar -->
<div class="container margin-top-20">
	<div class="row">
		<div class="our-slider">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
			  	
			  	@foreach($images as $image)
			    <div class="carousel-item {{$loop->index==0 ? 'active' : ''}}">
			      <img class="d-block w-100" src="{{asset('images/sliders/'.$image->image)}}" alt="First slide" height="200px" width="100px">
			    </div>
			    @endforeach
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
	</div>
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