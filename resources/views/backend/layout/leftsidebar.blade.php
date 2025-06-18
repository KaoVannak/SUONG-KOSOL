<aside class="main-sidebar sidebar-dark-primary elevation-4" style="height: 1100px">
    <!-- Brand Logo -->
    {{-- <a href="{{url('/dashboard')}}" class="brand-link"> --}}
      {{-- <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      {{-- <span class="brand-text font-weight-light">ST25-WebProject</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">SUONG KOSOL</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item @yield('d_menu-open')">
            <a href="#" class="nav-link @yield('d_active')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Manage Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{url('/dashboard')}}" class="nav-link @yield('d_active')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @yield('m_menu-open')">
            <a href="{{url('/branches')}}" class="nav-link @yield('m_active')"> 
              <i class="nav-icon fas fa-copy"></i>
             Branch 
            </a>
            
          </li>

          <li class="nav-item @yield('c_menu-open')">
            <a href="{{url('/categories')}}" class="nav-link @yield('c_active')">
              <i class="nav-icon fas fa-copy"></i>
              Categories
            </a>
           
          </li>

          <li class="nav-item @yield('p_menu-open')">
            <a href="{{url('/products')}}" class="nav-link @yield('p_active')">
              <i class="nav-icon fas fa-copy"></i>
              Products
            </a>
           
          </li>

          
          
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
   
    <!-- /.sidebar -->
  </aside>