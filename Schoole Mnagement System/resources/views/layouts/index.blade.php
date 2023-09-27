<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/index/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/index/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/index/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/index/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/index/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/index/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/index/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/index/plugins/summernote/summernote-bs4.min.css">
    @yield('styles')
    <style>
        #user-list {
            display: none;
        }

        #user-list.show-list {
            display: block;
        }
    </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/index/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

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
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                   role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        @php $var = Auth::user()->role . '.dashboard' ;  @endphp

        <a href="{{route($var)}}" class="brand-link">
            <i class="fas fa-school ml-2"></i>
            <span class="brand-text font-weight-light ml-2 mb-1">School System</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @php $photo = '/uploads/admins/' . Auth::user()->img @endphp
                    <a href="#" class="toggle-list" data-list="user-list">
                        <img src="{{$photo}}" class="img-circle elevation-2" alt="User Image">
                    </a>
                </div>
                <div class="info">
                    <a href="#" class="toggle-list" data-list="user-list">
                        {{Auth::user()->name}}
                    </a>
                </div>
            </div>
            <ul id="user-list" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item" style="margin-top: -15px; margin-bottom: 20px">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            @if(Auth::user()->role == 'student')
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    {{__('Courses')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('student.course.show')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('All Courses')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    {{__('Certificates')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('student.certif.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('certificates')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    {{__('Profile')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('student.profile.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('Profile')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            @elseif(Auth::user()->role == 'admin')
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    {{__('Admins')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('All Admin')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('Add Admin')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    {{__('Teachers')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('teacher.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('All Teachers')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('teacher.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('Add Teacher')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    {{__('Students')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('student.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('All Students')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('student.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('Add Student')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    {{__('Courses')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('course.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('All Courses')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('course.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('Add Course')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('certif.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('certificates')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            @elseif(Auth::user()->role == 'teacher')
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    {{__('Courses')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('teacher.course.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('All Courses')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    {{__('Attendance')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('attendance.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('Take Attendance')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>

            @endif
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @yield('content')

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
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
<script src="/index/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/index/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/index/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/index/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/index/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/index/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/index/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/index/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/index/plugins/moment/moment.min.js"></script>
<script src="/index/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/index/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/index/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/index/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/index/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/index/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/index/dist/js/pages/dashboard.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add click event listeners to toggle the user list
        const toggleLinks = document.querySelectorAll('.toggle-list');
        toggleLinks.forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const listId = this.getAttribute('data-list');
                const userList = document.getElementById(listId);
                userList.classList.toggle('show-list');
            });
        });
    });
</script>
@yield('scripts')
</body>
</html>
