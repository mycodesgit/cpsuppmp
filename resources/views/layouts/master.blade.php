<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CPSU || PPMP {{isset($title)?'| '.$title:''}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('template/img/CPSU_L.png') }}">

    <style type="text/css">
        .navbar-light .navbar-nav .nav-item.active .nav-link.active{
            background-color: #f1c40f !important ;
            color: #000 !important;
            border-radius: 3px;
        }
        .bg-greenn{
            background-color: #1f5036;
            color: #000 !important;
        }
        .nav-link{
            color: #fff !important;
        }
        .bg-selectEdit{
            background-color: #dcfdeb !important ;
            color: #000 !important;
        }
        
        .content-header {
            position: fixed !important;
            width: 100% !important;
            z-index: 999 !important;
        }

        .container-fluid {
            padding-right: 0 !important;
            padding-left: 0 !important;
            margin-right: auto !important;
            margin-left: auto !important;
        }
        .btn-app{
            color: #1f5036;
        }
        .btn-app:hover{
            background-color: #187744;
            color: #fff;
            border: #ffc107;
        }
        .btn-app.active{
            background-color: #187744;
            color: #fff;
            border: 1px blur #ffc107;
        }
        .nav-link2{
            font-size: 12pt;
            color: #000 !important;
            border-radius: 3px;
            display: block;
            padding: 0.5rem 1rem;
        }
        .nav-link2:hover{
            background-color: #187744 !important ;
            color: #fff !important;
            border-radius: 3px;
        }

        .nav-link2.active{
            background-color: #187744 !important ;
            color: #fff !important;
            border-radius: 1px blur #ffc107;
        }
        
    </style>
</head>

<body class="hold-transition layout-top-nav layout-navbar-fixed text-sm">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light bg-greenn">
            <div class="container-fluid">
                <a href="" class="navbar-brand">
                    <img src="{{ asset('template/img/CPSU_L.png') }}" alt="AdminLTE Logo" class="brand-image img-circle" style="box-shadow: 0 0 4px white;">
                    <span class="brand-text text-light"> Procurement Management System</span>
                </a>

                
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-user"></i>&nbsp;&nbsp;Signed In: {{Auth::user()->fname}}
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid" style="margin-top: auto">
                    @include('partials.control')
                </div>
            </div>

            <div class="content">
                @yield('body')
            </div>
        </div>

        
        <aside class="control-sidebar control-sidebar-dark">
            
        </aside>
   
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline ">
            Procurement Management System
        </div>
        Developed and Maintain by <i>Management Information System Office</i>.
    </footer>
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('template/plugins/toastr/toastr.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> 
<script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- jquery-validation -->
<script src="{{ asset('template/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('template/plugins/jquery-validation/additional-methods.min.js') }}"></script>

<script src="{{ asset('js/basic/tableScript.js') }}"></script>
<script src="{{ asset('js/basic/categoryScript.js') }}"></script>
<script src="{{ asset('js/basic/unitScript.js') }}"></script>
<script src="{{ asset('js/basic/itemScript.js') }}"></script>
<script src="{{ asset('js/basic/officeScript.js') }}"></script>

<script src="{{ asset('js/validation/categoryValidation.js') }}"></script>
<script src="{{ asset('js/validation/unitValidation.js') }}"></script>

<script>
    @if(Session::has('error'))
        toastr.options = {
            "closeButton":true,
            "progressBar":true,
            'positionClass': 'toast-bottom-right'
        }
        toastr.success("{{ session('success') }}")
    @endif
    @if(Session::has('error1'))
        toastr.options = {
            "closeButton":true,
            "progressBar":true,
            'positionClass': 'toast-bottom-center'
        }
        toastr.error("{{ session('error1') }}")
    @endif
</script>

<script>
    @if(Session::has('success'))
        toastr.options = {
            "closeButton":true,
            "progressBar":true,
            'positionClass': 'toast-bottom-right'
        }
        toastr.success("{{ session('success') }}")
    @endif
</script>

</body>
</html>
