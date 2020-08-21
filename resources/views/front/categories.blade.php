@extends('front.master')
@section('content')
<!-- start sidebar -->
<div class="container margin-top-20">
	<div class="row">
		@include('front.sidebar')
		<div class="col-md-8">
			<div class="widget">
				<h3>All Products in <span class="badge badge-primary">{{$categories->name}}</span></h3>
				@if(session('success'))
					<div class="alert alert-info">
							<p>{{session('error')}}</p>
					</div>
				@endif
				<?php $products=$categories->products()->paginate(9);?>
				@if($products->count()>0)
					@include('partials.all_products')
				@else
					<div class="alert alert-info">
						No Products is available in this category!!
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

<!-- End sidebar-->
@endsection