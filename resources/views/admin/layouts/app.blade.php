<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <!-- Google Font: Source Sans Pro -->
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source䦩﫨:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/style.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">
    <meta name="format-detection" content="telephone=no">
  </head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">

	  <!-- Navbar -->
	  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
	    <!-- Left navbar links -->
	    <ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
	      </li>
	    </ul>

	    <!-- Right navbar links -->
	    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
          <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
	      <li class="nav-item">
	        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
	          <i class="fas fa-expand-arrows-alt"></i>
	        </a>
	      </li>
	    </ul>
	  </nav>
	  <!-- /.navbar -->

	  <!-- Main Sidebar Container -->
	  <aside class="main-sidebar sidebar-dark-primary elevation-4">
	    <!-- Brand Logo -->
	    <a href="top.html" class="brand-link">
	      <img src="{{ asset('/assets/admin/images/site-icon.jpg') }}" alt="{{ config('app.name', 'Laravel') }} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
	      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
	    </a>

	    <!-- Sidebar -->
	    <div class="sidebar">
	      <!-- Sidebar user panel (optional) -->
	      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	        <div class="image">
	          <div class="icon" style="background-image:url({{ asset('/assets/admin/images/no-image.png') }});"></div>
	        </div>
	        <div class="info">
	          {{ Auth::user()->name }}
	        </div>
	      </div>

	      <!-- Sidebar Menu -->
	      <nav class="mt-2">
	        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	          <!-- Add icons to the links using the .nav-icon class
	               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="top.html" class="nav-link {{ request()->route()->named('admin.home') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt nav-icon"></i>
                <p>
                  ダッシュボード
                </p>
              </a>
            </li>
	          <li class="nav-item">
	            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->route()->named('admin.users.*') ? 'active' : '' }}">
	              <i class="fas fa-user nav-icon"></i>
	              <p>
	                ユーザ管理
	              </p>
	            </a>
	          </li>
	          <li class="nav-item {{ request()->route()->named('admin.jobs.*') ? 'menu-open' : '' }}">
	            <a href="#" class="nav-link  class="nav-link {{ request()->route()->named('admin.jobs.*') ? 'active' : '' }}">
	              <i class="far fa-newspaper nav-icon"></i>
	              <p>
	                求人管理
	                <i class="right fas fa-angle-left"></i>
	              </p>
	            </a>
	            <ul class="nav nav-treeview">
	              <li class="nav-item">
	                <a href="job-list.html" class="nav-link {{ request()->route()->named('admin.jobs.index') ? 'active' : '' }}">
	                  <i class="far fa-circle nav-icon"></i>
	                  <p>求人一覧</p>
	                </a>
	              </li>
	              <li class="nav-item">
	                <a href="job-edit.html" class="nav-link {{ request()->route()->named('admin.jobs.create') ? 'active' : '' }}">
	                  <i class="far fa-circle nav-icon"></i>
	                  <p>新規追加</p>
	                </a>
	              </li>
                <li class="nav-item">
                  <a href="category-list.html" class="nav-link {{ request()->route()->named('admin.jobs.categories.index') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>カテゴリ管理</p>
                  </a>
                </li>
	            </ul>
	          </li>
	        </ul>
	      </nav>
	      <!-- /.sidebar-menu -->
	    </div>
	    <!-- /.sidebar -->
	  </aside>

	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    @yield('content')
	  </div>
	  <!-- /.content-wrapper -->

	  <!-- Main Footer -->
	  <footer class="main-footer">
      Copyright &copy; 2021 {{ config('app.name', 'Laravel') }}
	  </footer>
	</div>
	<!-- ./wrapper -->


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/adminlte.min.js') }}"></script>
  </body>
</html>