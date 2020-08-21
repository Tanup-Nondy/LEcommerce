<nav class="sidebar sidebar-offcanvas scrollbar scrollbar-primary" id="sidebar" >
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="{{asset('images/faces/face8.jpg')}}" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">Allen Moreno</p>
                  <p class="designation">Premium user</p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">Main Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Manage Orders</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="products">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.orders')}}"> Manage Orders </a>
                    
                  </li>
    
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Manage Products</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="products">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.products')}}"> Manage Products </a>
                    
                  </li>
                  <li class="nav-item">
                  	<a class="nav-link" href="{{route('admin.products.create')}}"> Create Products </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="categories">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Manage Categories</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse show" id="categories">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.categories')}}"> Manage Categories </a>
                  </li>
                  <li class="nav-item">
                  	<a class="nav-link" href="{{route('admin.categories.create')}}"> Create Categories </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#brands" aria-expanded="false" aria-controls="brands">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Manage Brands</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse show" id="brands">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.brand')}}"> Manage Brands </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.brand.create')}}"> Create Brands </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#divisions" aria-expanded="false" aria-controls="divisions">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Manage Divisions</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse show" id="divisions">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.divisions')}}"> Manage Divisions </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.divisions.create')}}"> Create Divisions </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#districts" aria-expanded="false" aria-controls="districts">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Manage Districts</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse show" id="districts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.districts')}}"> Manage Districts </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.districts.create')}}"> Create Districts </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#sliders" aria-expanded="false" aria-controls="sliders">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Manage Sliders</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="sliders">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.slider')}}"> Manage Sliders </a>
                    
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <form action="{{route('admin.logout')}}" method="post" >
                  @csrf
                  <input type="submit" value="Logout" class="btn btn-danger" >
                </form>
              </a>
            </li>
          </ul>

        </nav>