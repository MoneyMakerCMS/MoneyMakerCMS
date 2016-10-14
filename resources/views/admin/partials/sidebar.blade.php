<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">

        <img src="{{Gravatar::get(Auth::user()->email)}}" class="img-circle" alt="User Image">

      </div>
      <div class="pull-left info">
        <p>{{Auth::user()->name ? : ''}}</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

   {{--  <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    --}}
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">ADMIN</li>
      <li class="{{ Active::pattern('admin/dashboard') }}">
        <a href="{{route('admin.dashboard.index')}}">Dashboard</a>
      </li>

      @allowed('view-users')
      <li class="{{ Active::pattern('admin/users*') }} treeview">
        <a href="#">
          <span>&nbsp;&nbsp;Users</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu {{ Active::pattern('admin/users*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/users*', 'display: block;') }}">
          <li class="{{ Active::pattern('admin/users') }}">
            <a href="{{route('admin.users.index')}}"><i class="fa fa-circle-thin"></i> All</a>
          </li>
          <li class="{{ Active::pattern('admin/users') }}">
            <a href="{{route('admin.users.create')}}"><i class="fa fa-circle-thin"></i> Create</a>
          </li>
        </ul>
      </li>
      @endif

      @allowed('view-roles')
      <li class="{{ Active::pattern('admin/roles*') }} treeview">
        <a href="#">
          <span>&nbsp;&nbsp;Roles</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu {{ Active::pattern('admin/roles*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/roles*', 'display: block;') }}">
          <li class="{{ Active::pattern('admin/roles') }}">
            <a href="{{route('admin.roles.index')}}"><i class="fa fa-circle-thin"></i> All</a>
          </li>
          <li class="{{ Active::pattern('admin/roles') }}">
            <a href="{{route('admin.roles.create')}}"><i class="fa fa-circle-thin"></i> Create</a>
          </li>
        </ul>
      </li>
      @endif

      @allowed('view-pages')
      <li class="{{ Active::pattern('admin/pages*') }} treeview">
        <a href="#">
          <span>&nbsp;&nbsp;Pages</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu {{ Active::pattern('admin/pages*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/pages*', 'display: block;') }}">
          <li class="{{ Active::pattern('admin/pages') }}">
            <a href="{{route('admin.pages.index')}}"><i class="fa fa-circle-thin"></i> All</a>
          </li>
          <li class="{{ Active::pattern('admin/pages') }}">
            <a href="{{route('admin.pages.create')}}"><i class="fa fa-circle-thin"></i> Create</a>
          </li>
        </ul>
      </li>
      @endif

      @allowed('view-contents')
      <li class="{{ Active::pattern('admin/content*') }} treeview">
        <a href="#">
          <span>&nbsp;&nbsp;Content</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu {{ Active::pattern('admin/content*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/content*', 'display: block;') }}">
          <li class="{{ Active::pattern('admin/content') }}">
            <a href="{{route('admin.content.index')}}"><i class="fa fa-circle-thin"></i> All</a>
          </li>
          <li class="{{ Active::pattern('admin/content') }}">
            <a href="{{route('admin.content.create')}}"><i class="fa fa-circle-thin"></i> Create</a>
          </li>
        </ul>
      </li>
      @endif
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>