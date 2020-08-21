@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Update Division
				</div>
				<div class="card-body">
					<form action="{{route('admin.divisions.update',$division->id)}}" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
					
						  <div class="form-group{{$errors->has('name')? 'has-error':''}}">
						    <label for="name">Name </label>
						    <input type="text" name="name" class="form-control" value="{{$division->name}}">
						    <span class="text-danger">{{$errors->first('name')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('priority')? 'has-error':''}}">
						    <label for="priority">Priority</label>
						    <textarea name="priority" rows="8" cols='80' class="form-control">{{$division->priority}}</textarea> 
						    <span class="text-danger">{{$errors->first('priority')}}</span>
						  </div>
						  
						  <button type="submit" class="btn btn-primary">Update</button>
					</form>
				</div>
			</div>
        </div>
  </div>
@endsection

