
@extends('admin.index')


@section('adminContent')
<div class="wrapper">

    <!-- Preloader -->
    {{-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="Admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div> --}}
  
    <!-- Navbar -->
    @include("admin.components.navbar")
    <!-- /.navbar -->
  
    <!-- Main Sidebar Container -->
    @include("admin.components.sidebar")
  
    <!-- Content Wrapper. Contains page content -->
   
    @yield('adminSection')
   
    <!-- /.content-wrapper -->
   @include("admin.components.footer")
  
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endsection