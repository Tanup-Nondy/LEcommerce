@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Manage Categories
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
								<th>Category Name</th>
								<th>Image</th>
								<th>Parent Category</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($categories as $category)
							<tr>
								<td>#</td>
								<td>{{$category->name}}</td>
								<td>
									<img src="{{asset('images/categories/'.$category->image)}}" width="100px" height="100px">
								</td>
								<td>
									@if($category->parent_id==null)
										Primary category
									@else
										{{$category->parent->name}}
									@endif
								</td>
								<td>
									<a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-success">Edit</a>
									<a class="btn btn-danger" href="#deleteModal{{$category->id}}" data-toggle="modal">Delete</a>
								</td>
								<div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  								<div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Delete Category</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <form id="regForm" action="{{route('admin.categories.delete',$category->id)}}" method="post">
							        	{{csrf_field()}}
										<button type="submit" class="btn btn-danger" >Delete Category</button>
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