@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Manage Divisions
				</div>
				<div class="card-body">
					@if(session('success'))
					<div class="alert alert-info">
						
							<p>{{session('success')}}</p>
						
					</div>
					@endif
					<table id="datatable" class="table table-hover table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>District Name</th>
								<th>Division Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($districts as $district)
							<tr>
								<td>#</td>
								<td>{{$district->name}}</td>
								<td>{{$district->division->name}}</td>
								<td>
									<a href="{{route('admin.districts.edit',$district->id)}}" class="btn btn-success">Edit</a>
									<a class="btn btn-danger" href="#deleteModal{{$district->id}}" data-toggle="modal">Delete</a>
								</td>
								<div class="modal fade" id="deleteModal{{$district->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  								<div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Delete Division</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <form id="regForm" action="{{route('admin.districts.delete',$district->id)}}" method="post">
							        	{{csrf_field()}}
										<button type="submit" class="btn btn-danger" >Delete Division</button>
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