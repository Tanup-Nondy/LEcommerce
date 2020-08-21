@extends('admin.master')
@section('content')
  <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
				<div class="card-header">
					Manage Sliders
				</div>
				<div class="card-body">
					@if(session('success'))
					<div class="alert alert-info">
						
							<p>{{session('success')}}</p>
						
					</div>
					@endif
					<a class="btn btn-danger" href="#addSliderModal" data-toggle="modal">Add New Slider</a>

					<!-- Add modal-->
					<div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  						<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Add New Slider</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					    <div class="modal-body">
						<form id="regForm" action="{{route('admin.slider.store')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="form-group{{$errors->has('title')? 'has-error':''}}">
						    <label for="title">Slider Title <small class="text-danger">(required)</small> </label>
						    <input type="text" name="title" class="form-control" placeholder="Slider Title">
						    <span class="text-danger">{{$errors->first('title')}}</span>
						</div>
						<div class="form-group{{$errors->has('image')? 'has-error':''}}">
						    <label for="image">Slider Image <small class="text-danger">(required)</small> </label>
						    <input type="file" name="image" class="form-control" placeholder="Slider image">
						    <span class="text-danger">{{$errors->first('image')}}</span>
						</div>
						<div class="form-group{{$errors->has('button_text')? 'has-error':''}}">
						    <label for="button_text">Slider Button Text <small class="text-danger">(optional)</small> </label>
						    <input type="text" name="button_text" class="form-control" placeholder="Slider Button Text">
						    <span class="text-danger">{{$errors->first('button_text')}}</span>
						</div>
						<div class="form-group{{$errors->has('button_link')? 'has-error':''}}">
						    <label for="button_link">Slider Button Link <small class="text-danger">(optional)</small> </label>
						    <input type="url" name="button_link" class="form-control" placeholder="Slider Button Link">
						    <span class="text-danger">{{$errors->first('button_link')}}</span>
						</div>
						<div class="form-group{{$errors->has('priority')? 'has-error':''}}">
						    <label for="priority">Slider Priority <small class="text-danger">(required)</small> </label>
						    <input type="number" name="priority" class="form-control" placeholder="Slider Priority">
						    <span class="text-danger">{{$errors->first('priority')}}</span>
						</div>
			            <button type="submit" class="btn btn-danger" >Add new Slider</button>
						</form>
						</div>
					    <div class="modal-footer">
						<button type="button"class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						</div>
					    </div>
				        </div>
					</div>
					<table id="datatable" class="table table-hover table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Slider Title</th>
								<th>Slider Image</th>
								<th>Slider Priority</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($sliders as $slider)
							<tr>
								<td>#</td>
								<td>{{$slider->name}}</td>
								<td><img src="{{asset('images/sliders/'.$slider->image)}}" width="100px" height="100px"></td>
								<td>{{$slider->priority}}</td>
								<td>
									<a href="#editModal{{$slider->id}}" class="btn btn-success">Edit</a>

									<a class="btn btn-danger" href="#deleteModal{{$slider->id}}" data-toggle="modal">Delete</a>
								</td>

								<!-- Edit modal-->
								<div class="modal fade" id="editModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  						<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit Slider</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
						</button>
					    </div>
					    <div class="modal-body">
						<form id="regForm" action="{{route('admin.slider.update',$slider->id)}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="form-group{{$errors->has('title')? 'has-error':''}}">
						    <label for="title">Slider Title <small class="text-danger">(required)</small> </label>
						    <input type="text" name="title" class="form-control" placeholder="Slider Title" value="{{$slider->title}}">
						    <span class="text-danger">{{$errors->first('title')}}</span>
						</div>
						<div class="form-group{{$errors->has('image')? 'has-error':''}}">
						    <label for="Old image">Old Image </label><br>
						    <img src="{{asset('images/sliders/'.$slider->image)}}" width="100px" height="100px"><br><br>
						    <label for="image">New Image (Optional)</label>
						    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						    <!--<input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">-->
						    <span class="text-danger">{{$errors->first('image')}}</span>
						  </div>
						<div class="form-group{{$errors->has('button_text')? 'has-error':''}}">
						    <label for="button_text">Slider Button Text <small class="text-danger">(optional)</small> </label>
						    <input type="text" name="button_text" class="form-control" placeholder="Slider Button Text" value="{{$slider->button_text}}">
						    <span class="text-danger">{{$errors->first('button_text')}}</span>
						</div>
						<div class="form-group{{$errors->has('button_link')? 'has-error':''}}">
						    <label for="button_link">Slider Button Link <small class="text-danger">(optional)</small> </label>
						    <input type="url" name="button_link" class="form-control" placeholder="Slider Button Link" value="{{$slider->button_link}}">
						    <span class="text-danger">{{$errors->first('button_link')}}</span>
						</div>
						<div class="form-group{{$errors->has('priority')? 'has-error':''}}">
						    <label for="priority">Slider Priority <small class="text-danger">(required)</small> </label>
						    <input type="number" name="priority" class="form-control" placeholder="Slider Priority" value="{{$slider->priority}}">
						    <span class="text-danger">{{$errors->first('priority')}}</span>
						</div>
			            <button type="submit" class="btn btn-danger" >Edit Slider</button>
						</form>
						</div>
					    <div class="modal-footer">
						<button type="button"class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						</div>
					    </div>
				        </div>
					</div>
								<!-- delete modal -->
								<div class="modal fade" id="deleteModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  								<div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Delete slider</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <form id="regForm" action="{{route('admin.slider.delete',$slider->id)}}" method="post">
							        	{{csrf_field()}}
										<button type="submit" class="btn btn-danger" >Delete Slider</button>
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