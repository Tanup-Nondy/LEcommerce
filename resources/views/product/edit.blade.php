@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Add Product
				</div>
				<div class="card-body">
					<form action="{{route('admin.products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
					
						  <div class="form-group{{$errors->has('title')? 'has-error':''}}">
						    <label for="title">Title </label>
						    <input type="text" name="title" class="form-control" value="{{$product->title}}">
						    <span class="text-danger">{{$errors->first('title')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('description')? 'has-error':''}}">
						    <label for="title">Description </label>
						    <textarea name="description" rows="8" cols='80' class="form-control" >{{$product->description}}</textarea> 
						    <span class="text-danger">{{$errors->first('description')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('quantity')? 'has-error':''}}">
						    <label for="quantity">Quantity </label>
						    <input type="number" name="quantity" class="form-control" value="{{$product->quantity}}">
						    <span class="text-danger">{{$errors->first('quantity')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('category')? 'has-error':''}}">
						    <label for="category">Select Category</label>
						    <select name="category_id" id="category" class="form-control">
									<option value="">--Select Category--</option>
									@foreach(App\Category::orderBy('name','asc')->where('parent_id',NULL)->get() as $par_cat)
										<option value="{{$par_cat->id}}" {{$par_cat->id==$product->category_id ? 'selected' :''}}>{{$par_cat->name}}</option>
										@foreach(App\Category::orderBy('name','asc')->where('parent_id',$par_cat->id)->get() as $child_cat)
											<option value="{{$child_cat->id}}" {{$child_cat->id==$product->category_id ? 'selected' :''}}>------->{{$child_cat->name}}</option>
										@endforeach
									@endforeach
							</select>
						    <span class="text-danger">{{$errors->first('category')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('brand')? 'has-error':''}}">
						    <label for="brand">Select Brand</label>
						    <select name="brand_id" id="brand" class="form-control">
									<option value="">--Select Brand--</option>
									@foreach(App\Brand::orderBy('name','asc')->get() as $brand)
										<option value="{{$brand->id}}" {{$brand->id==$product->brand_id ? 'selected' :''}}>{{$brand->name}}</option>}
									@endforeach
							</select>
						    <span class="text-danger">{{$errors->first('brand')}}</span>
						  </div>

						  <div class="form-group{{$errors->has('price')? 'has-error':''}}">
						    <label for="price">Price </label>
						    <input type="number" name="price" class="form-control" value="{{$product->price}}">
						    <span class="text-danger">{{$errors->first('price')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('status')? 'has-error':''}}">
						    <label for="status">Status </label>
						    <input type="text" name="status" class="form-control" value="{{$product->status}}">
						    <span class="text-danger">{{$errors->first('status')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('oprice')? 'has-error':''}}">
						    <label for="oprice">Offer Price </label>
						    <input type="number" name="oprice" class="form-control" value="{{$product->offer_price}}">
						    <span class="text-danger">{{$errors->first('oprice')}}</span>
						  </div>
						  <div class="form-group{{$errors->has('image')? 'has-error':''}}">
						    <label for="image">Image </label>
						    <div class="row">
						    	<div class="col-md-4">
						    		<input type="file" name="image[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    	</div>
						    	<div class="col-md-4">
						    		<input type="file" name="image[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    	</div>
						    	<div class="col-md-4">
						    		<input type="file" name="image[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    	</div>
						    	<div class="col-md-4">
						    		<input type="file" name="image[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    	</div>
						    	<div class="col-md-4">
						    		<input type="file" name="image[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    	</div>
						    </div>
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

