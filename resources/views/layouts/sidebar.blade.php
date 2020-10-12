  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          Whatshopy
          <!-- <img src="{{asset('assets/img/brand/blue.png')}}" class="navbar-brand-img" alt="..."> -->
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link {{request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">{{__('Dashboard')}}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{request()->routeIs('categories.index') ? 'active' : '' }}" href="{{route('categories.index')}}">
                <i class="ni ni-books text-primary"></i>
                <span class="nav-link-text">{{__('Category')}}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{request()->routeIs('products.index') ? 'active' : '' }}" href="{{route('products.index')}}">
                <i class="ni ni-basket text-orange"></i>
                <span class="nav-link-text">{{__('Products')}}</span>
              </a>
            </li>
            
<!--             <li class="nav-item">
              <a class="nav-link {{request()->routeIs('users.index') ? 'active' : '' }}" href="{{route('users.index')}}">
                <i class="ni ni-single-02 text-default"></i>
                <span class="nav-link-text">{{__('Users')}}</span>
              </a>
            </li> -->
    
          </ul>
        </div>
      </div>
    </div>
  </nav>