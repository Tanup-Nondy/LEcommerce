@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Add Division
				</div>
				<div class="card-body">
					@if(session('success'))
					<div class="alert alert-info">
						
							<p>{{session('success')}}</p>
						
					</div>
					@endif
					<form action="{{route('admin.divisions.store')}}" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
					
						  <div class="form-group{{$errors->has('name')? 'has-error':''}}">
						    <label for="title">Name </label>
						    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    <span class="text-danger">{{$errors->first('name')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('priority')? 'has-error':''}}">
						    <label for="priority">Priority </label>
						    <input type="number" name="priority" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    <span class="text-danger">{{$errors->first('priority')}}</span>
						  </div>
						  <button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
        </div>
  </div>
@endsection

