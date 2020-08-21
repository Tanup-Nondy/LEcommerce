@extends('front.master')
@section('content')
<!-- start sidebar -->
<div class="container margin-top-20">
	<div class="row">
		<div class="col-md-4">
			<div class="list-group">
			  <a href="#" class="list-group-item list-group-item-action ">
			    Cras justo odio
			  </a>
			  <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
			  <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
			  <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
			</div>
		</div>
		<div class="col-md-8">
			<div class="widget">
				<h3>Searched Products For - <span class="badge badge-primary">{{$search}}</span></h3>
				@include('partials.all_products')
			</div>
		</div>
	</div>
</div>

<!-- End sidebar-->
@endsection