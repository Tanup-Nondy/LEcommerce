				<div class="row">
					@foreach($products as $product)
					<div class="col-md-4">
						<div class="card" style="height:250px">
						  <?php $i=1;?>
						  @foreach($product->images as $image)
							@if($i>0)
								<a href="{{route('products.show',$product->slug)}}" >
						  		<img src="{{asset('images/products/'.$image->image)}}" class="card-img-top featured-img" width="100px" height="100px" alt="{{$product->title}}">
						  		</a>
						  	@endif
						  	<?php $i--;?>
						  @endforeach
						  <div class="card-body">
						    <h5 class="card-title">
						    	<a href="{{route('products.show',$product->slug)}}" >{{$product->title}}</a>
						    </h5>
						    <p class="card-text">{{$product->price}}</p>
						    @include('partials.cart_button')
						  </div>
						</div>
					</div>
					@endforeach
					
				</div>
				<div class="mt-4 pagination">
					{{$products->links()}}
				</div>