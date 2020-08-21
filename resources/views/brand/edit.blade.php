@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Update Brand
				</div>
				<div class="card-body">
					<form action="{{route('admin.brand.update',$brand->id)}}" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
					
						  <div class="form-group{{$errors->has('name')? 'has-error':''}}">
						    <label for="title">Name </label>
						    <input type="text" name="name" class="form-control" value="{{$brand->name}}">
						    <span class="text-danger">{{$errors->first('name')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('description')? 'has-error':''}}">
						    <label for="title">Description (Optional)</label>
						    <textarea name="description" rows="8" cols='80' class="form-control">{{$brand->name}}</textarea> 
						    <span class="text-danger">{{$errors->first('description')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('image')? 'has-error':''}}">
						    <label for="Old image">Old Image </label><br>
						    <img src="{{asset('images/brands/'.$brand->image)}}" width="100px" height="100px"><br><br>
						    <label for="image">New Image (Optional)</label>
						    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    <!--<input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">-->
						    <span class="text-danger">{{$errors->first('image')}}</span>
						  </div>
						  <button type="submit" class="btn btn-primary">Update</button>
					</form>
				</div>
			</div>
        </div>
  </div>
@endsection

