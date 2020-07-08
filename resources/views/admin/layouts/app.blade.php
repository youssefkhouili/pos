<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- bootstrap 4.5  --}}
  <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/skin-blue.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.css') }}">
  <!-- Font Awesome -->
  @if (app()->getLocale() === 'ar')
  <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome-rtl.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/adminlte-rtl.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap-rtl.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/rtl.css') }}">
  @else
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('dashboard/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @endif
  <link rel="stylesheet" href="{{ asset ('dashboard/css/style.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  @include('admin.layouts._navbar')


  @include('admin.layouts._main-aside')



  <div class="content-wrapper">
    @yield('content')
  </div>
    @include('admin.partials._errors')
  <footer class="main-footer" style="margin-left: 0">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
</body>
</html>
