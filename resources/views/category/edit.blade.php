@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Update Category
				</div>
				<div class="card-body">
					<form action="{{route('admin.categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
					
						  <div class="form-group{{$errors->has('name')? 'has-error':''}}">
						    <label for="title">Name </label>
						    <input type="text" name="name" class="form-control" value="{{$category->name}}">
						    <span class="text-danger">{{$errors->first('name')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('description')? 'has-error':''}}">
						    <label for="title">Description (Optional)</label>
						    <textarea name="description" rows="8" cols='80' class="form-control">{{$category->name}}</textarea> 
						    <span class="text-danger">{{$errors->first('description')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('category')? 'has-error':''}}">
								<label for="category">Parent Category (Optional)</label>
								<select name="parent_id" id="category" class="form-control">
									<option value="">--Select Category--</option>
									@foreach($parent_cat as $par_cat)
										<option value="{{$par_cat->id}}" {{$par_cat->id==$category->parent_id ? 'selected' :''}}>{{$par_cat->name}}
										</option>
									@endforeach
								</select>
								<span class="text-danger">{{$errors->first('category')}}</span>
							</div>
						  <div class="form-group{{$errors->has('image')? 'has-error':''}}">
						    <label for="Old image">Old Image </label><br>
						    <img src="{{asset('images/categories/'.$category->image)}}" width="100px" height="100px"><br><br>
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

