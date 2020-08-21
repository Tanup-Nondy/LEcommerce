
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
		<div class="container">
  <a class="navbar-brand {{Route::is('front.index') ? 'active' : ''}}" href="{{route('front.index')}}"><img src="{{asset('images/favicon.png')}}" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item nav_link">
        <a class="nav-link {{Route::is('front.index') ? 'active' : ''}}" href="{{route('front.index')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{Route::is('products') ? 'active' : ''}}" href="{{route('products')}}">Products</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
      <li class="nav-item">
        <form class="form-inline my-2 my-lg-0" method="get" action="{{route('search')}}"> 
          <div class="input-group mb-3">
            <input type="text" class="typeahead form-control" name="search" placeholder="Search product" autocomplete="off">
            <div class="input-group-append">
            <button class="btn btn-outline-secondary search_icon_btn" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>
      </li>
    </ul>
   <ul class="navbar-nav ml-auto">
    <li>
      <a class="nav-link btn_cart_nav" href="{{route('carts')}}">
        <button class="btn btn-danger">
          <span class="mt-1">cart</span>
          <span class="badge badge-warning" id="total_items">
            {{App\CartModel::total_items()}}
          </span>
        </button>
      </a>
    </li>
    @guest
                            <li class="nav-item">
                                <a class="nav-link btn_cart_nav" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle btn_cart_nav" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{App\Helpers\ImageHelper::getUserImage(Auth::user()->id)}}" class="img rounded-circle" style="width:40px;"alt="">
                                    {{ Auth::user()->f_name }} {{ Auth::user()->l_name }}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                        {{ __('Dashboard') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
   </ul>
   <script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>
  </div>
  </div>
</nav>
