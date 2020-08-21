<!DOCTYPE html>
<html>
<head>
	<title>@yield('title','LEcommerce')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/c93d05ff23.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css/index_style.css')}}?ver=1.2">
	<!--<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
</head>
<body>
<div class="wrapper">
	
	@include('front.nav')
<!--END Navbar -->

<!-- main-content-->
	@yield('content')
<!--end main-content-->
<footer class="footer-bottom">
	<p class="text-center">&copy; 2109 all rights reserved | LEcommerce</p>
</footer>
</div>
<!-- script for typeahead -->
<!--<script src="{{asset('js/jquery-3.4.1.slim.min.js')}}"></script>-->
@include('partials.scripts')
@yield('scripts')
</body>
</html>