@extends('front.master')
@section('title')
	{{$product->title}}|LEcommerce
@endsection
@section('content')
<!-- start sidebar -->
<div class="container margin-top-20">
	<div class="row">
		<div class="col-md-4">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
			  	<?php $i=1;?>
			  	@foreach($product->images as $image)
			    <div class="carousel-item {{$i==1 ? 'active' : ''}}">
			      <img class="d-block w-100" src="{{asset('images/products/'.$image->image)}}" alt="First slide" height="200px" width="100px">
			    </div>
			    <?php $i++;?>
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
		<div class="col-md-8">
			<div class="widget">
				<h3>{{$product->title}}</h3>
				<h3>{{$product->price}} Taka
					<span class="badge badge-primary">
						{{$product->quantity <1 ? 'No item is available in stock!' : $product->quantity.' items is available in stock'}}
					</span>
				</h3>
				<hr>
				<div class="product-description">
					{{$product->description}}
				</div>
			</div>
		</div>
	</div>
</div>

<!-- End sidebar-->
@endsection