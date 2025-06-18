<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminST25 |-@yield('title') </title>

  @include('backend.layout.styleshope')
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
    @include('backend.layout.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('backend.layout.leftsidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
        @yield('content')
        <!-- /.row -->
     
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('backend.layout.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('backend.layout.jsshope')

</body>
</html>
