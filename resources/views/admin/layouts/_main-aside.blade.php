<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('dashboard.index') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <span>@lang('site.dashboard')</span>
            </a>
          </li>
          @if (auth()->user()->hasPermission('read_categories'))
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('dashboard.categories.index') }}" class="nav-link active">
            <i class="fas fa-users"></i>
              <span>@lang('site.categories')</span>
            </a>
          </li>
          @endif
          @if (auth()->user()->hasPermission('read_products'))
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('dashboard.products.index') }}" class="nav-link active">
            <i class="fas fa-users"></i>
              <span>@lang('site.products')</span>
            </a>
          </li>
          @endif
          @if (auth()->user()->hasPermission('read_users'))
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('dashboard.users.index') }}" class="nav-link active">
            <i class="fas fa-users"></i>
              <span>@lang('site.users')</span>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
