@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Manage Product
				</div>
				<div class="card-body">
					@if(session('success'))
					<div class="alert alert-info">
						
							<p>{{session('success')}}</p>
						
					</div>
					@endif
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Product Title</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $product)
							<tr>
								<td>#</td>
								<td>{{$product->title}}</td>
								<td>{{$product->price}}</td>
								<td>{{$product->quantity}}</td>
								<td>{{$product->title}}</td>
								<td>
									<a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-success">Edit</a>
									<a class="btn btn-danger" href="#deleteModal{{$product->id}}" data-toggle="modal">Delete</a>
								</td>
							</tr>
							<div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Add Class Schedule</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <form id="regForm" action="{{route('admin.products.delete',$product->id)}}" method="post">
							        	{{csrf_field()}}
										{{method_field('DELETE')}}
										<button type="submit" class="btn btn-danger" >Delete Product</button>
									</form>
							    </div>
							    <div class="modal-footer">
							    	<button type="button"class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							    </div>
							  </div>
							</div>
						</div>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
        </div>
  </div>


@endsection