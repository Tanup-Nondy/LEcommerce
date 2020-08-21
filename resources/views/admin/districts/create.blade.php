@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Add District
				</div>
				<div class="card-body">
					@if(session('success'))
					<div class="alert alert-info">
						
							<p>{{session('success')}}</p>
						
					</div>
					@endif
					<form action="{{route('admin.districts.store')}}" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
					
						  <div class="form-group{{$errors->has('name')? 'has-error':''}}">
						    <label for="title">Name </label>
						    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    <span class="text-danger">{{$errors->first('name')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('division_id')? 'has-error':''}}">
						    <label for="division_id">Division ID </label>
						    <select name="division_id" id="division" class="form-control">
									<option value="">--Select Division--</option>
									@foreach(App\Divisions::orderBy('priority','asc')->get() as $divs)
										<option value="{{$divs->id}}">{{$divs->name}}</option>}
									@endforeach
							</select>
						    <span class="text-danger">{{$errors->first('division_id')}}</span>
						  </div>
						  <button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
        </div>
  </div>
@endsection

