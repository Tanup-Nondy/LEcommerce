@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Add Brand
				</div>
				<div class="card-body">
					@if(session('success'))
					<div class="alert alert-info">
						
							<p>{{session('success')}}</p>
						
					</div>
					@endif
					<form action="{{route('admin.brand.store')}}" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
					
						  <div class="form-group{{$errors->has('name')? 'has-error':''}}">
						    <label for="title">Name </label>
						    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    <span class="text-danger">{{$errors->first('name')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('description')? 'has-error':''}}">
						    <label for="title">Description </label>
						    <textarea name="description" rows="8" cols='80' class="form-control"></textarea> 
						    <span class="text-danger">{{$errors->first('description')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('image')? 'has-error':''}}">
						    <label for="image">Image </label>
						    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    <span class="text-danger">{{$errors->first('image')}}</span>
						  </div>
						  <button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
        </div>
  </div>
@endsection

