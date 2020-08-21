@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Manage Brands
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
								<th>Brand Name</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($brands as $brand)
							<tr>
								<td>#</td>
								<td>{{$brand->name}}</td>
								<td>
									<img src="{{asset('images/brands/'.$brand->image)}}" width="100px" height="100px">
								</td>
								<td>
									<a href="{{route('admin.brand.edit',$brand->id)}}" class="btn btn-success">Edit</a>
									<a class="btn btn-danger" href="#deleteModal{{$brand->id}}" data-toggle="modal">Delete</a>
								</td>
								<div class="modal fade" id="deleteModal{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  								<div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Delete Brand</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <form id="regForm" action="{{route('admin.brand.delete',$brand->id)}}" method="post">
							        	{{csrf_field()}}

										<button type="submit" class="btn btn-danger" >Delete Brand</button>
									</form>
							    </div>
							    <div class="modal-footer">
							    	<button type="button"class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							    </div>
							  </div>
							</div>
							</div>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
        </div>
  </div>


@endsection