<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
<script>
	function addToCart(product_id){
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		//http://127.0.0.1:8000/api/carts/store for server host
		//http://localhost/LEcommerce/public/carts/store for server
		var url="{{url('/')}}";
		$.post( url+"/api/carts/store", { product_id:product_id})
			.done(function( data ) {
			data=JSON.parse(data);
			if(data.status=='success'){
				alertify.set('notifier','position', 'top-center');
 				alertify.success('Item added to cart succesfully !! Total Items: '+data.totalItems+'<br/>To checkout <a href="{{route('checkouts')}}">go to checkout page</a>');
				$("#total_items").html(data.totalItems); 
			}
		});
	}
</script>