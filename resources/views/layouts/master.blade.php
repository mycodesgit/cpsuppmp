<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CPSU || Purchase Request {{isset($title)?'| '.$title:''}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free-V6/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/dist/css/theme.min.css') }}">

    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('template/img/CPSU_L.png') }}">

    <style type="text/css">
        .navbar-light .navbar-nav .nav-item.active .nav-link.active{
            background-color: #f1c40f !important ;
            color: #000 !important;
            border-radius: 3px;
        }
        .bg-greenn{
            background-color: #04401f;
            color: #000 !important;
        }
        .nav-link{
            color: #fff !important;
        }
        .bg-selectEdit{
            background-color: #dcfdeb !important ;
            color: #000 !important;
        }
        .center-top {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .content-header {
            position: fixed !important;
            width: 100% !important;
            z-index: 999 !important;
        }

        .container-fluid {
            padding-right: 1% !important;
            padding-left: 1% !important;
            margin-right: auto !important;
            margin-left: auto !important;
        }
        .btn-app{
            color: #04401f;
            box-shadow: 1px 2px 3px rgba(0, 0, 0, 0.2) !important;
            font-size: 11pt !important;
            font-weight: bold;
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
        .nav-link{
            color: #000 !important;
        }
        .nav-link.active{
            /*background-color: #187744 !important ;*/
            color: #000 !important;
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

        a.list-group-item {
            font-size: 12pt !important;
            color: #000 !important;
            padding: 8px !important;
        }

        a.list-group-item:focus,
        a.list-group-item:hover,
        a.list-group-item.active,
        button.list-group-item:focus,
        button.list-group-item:hover {
            background-color: #187744 !important;
            color: #fff !important;
            border-color: #04401f;
        }
        .green {
            background-color: #04401f !important;
            color: #fff;
        }
        .green:hover {
            background-color: #187744 !important;
            color: #fff;
        }
        .bg-welcome {
            background-color: #d1f1e7 !important;
        }
        .col-12 {
            transition: transform 0.1s ease;
        }
        .col-12:hover {
            transform: scale(1.02);
        }
        .btn-success {
            background-color: #187744  !important;
            border-color: #187744  !important;
            color: #fff;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav layout-navbar-fixed text-sm">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light bg-greenn">
            <div class="container-fluid">
                <a href="" class="mt-1">
                    <img src="{{ asset('template/img/CPSU_L.png') }}" alt="AdminLTE Logo" class="brand-image img-circle" style="box-shadow: 0 0 3px white;">
                    <span class="text-light" style="font-size: 12pt; font-family: Courier"> Purchase Request</span>
                </a>
                {{-- <div class="" style="z-index: 999">
                    <img src="{{ asset('template/img/CPSU_L.png') }}" style="width:80px;" class="center-top">
                </div> --}}
                
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button" style="color: #fff !important">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" style="color: #fff !important">
                            <i class="fas fa-user"></i>&nbsp;&nbsp;Signed In: {{Auth::user()->fname}} - {{Auth::user()->office->office_abbr}}
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid" style="margin-top: -9px">
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
            Purchase Request Management System
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
<!-- Moment -->
<script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>

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
<script src="{{ asset('js/basic/requestitemScript.js') }}"></script>

<script src="{{ asset('js/validation/purposeValidation.js') }}"></script>
<script src="{{ asset('js/validation/categoryValidation.js') }}"></script>
<script src="{{ asset('js/validation/unitValidation.js') }}"></script>
<script src="{{ asset('js/validation/itemValidation.js') }}"></script>
<script src="{{ asset('js/validation/officeValidation.js') }}"></script>
<script src="{{ asset('js/validation/requestprValidation.js') }}"></script>
<script src="{{ asset('js/validation/userValidation.js') }}"></script>
<script src="{{ asset('js/validation/passValidation.js') }}"></script>



@if(request()->routeIs('pendingAllListRead'))
    <script src="{{ asset('js/ajax/allpending.js') }}"></script>
@endif

@if(request()->routeIs('pendingListRead'))
    <script src="{{ asset('js/ajax/pending.js') }}"></script>
@endif

@if(request()->routeIs('pendingAllBudgetListRead'))
    <script src="{{ asset('js/ajax/allpendingBudget.js') }}"></script>
@endif

@if(request()->routeIs('approvedListAllRead',))
    <script src="{{ asset('js/ajax/allapproved.js') }}"></script>
@endif

@if(request()->routeIs('approvedListRead'))
    <script src="{{ asset('js/ajax/alluserapproved.js') }}"></script>
@endif

<script src="{{ asset('js/ajax/allCountApproved.js') }}"></script>
<script src="{{ asset('js/ajax/userCountApproved.js') }}"></script>
<script src="{{ asset('js/ajax/allCountPendingB.js') }}"></script>
<script src="{{ asset('js/ajax/userCountPending.js') }}"></script>
<script src="{{ asset('js/ajax/allCountPending.js') }}"></script>

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

<script>
    function resetFormFields() {
        $('input[name="qty"]').val('');
        $('input[name="total_cost"]').val('');
    }
    $(document).ready(function() {
        $(document).on('click', '.btn-selectitem', function (e) {
            e.preventDefault();

            var itemId = $(this).data('id');
            var itemName = $(this).closest('tr').find('td:eq(1)').text();
            var unitId = $(this).closest('tr').find('td:eq(0)').text();
            var unitName = $(this).closest('tr').find('td:eq(2)').text();
            var itemCost = $(this).closest('tr').find('td:eq(3)').text();

            $('input[name="item_id"]').val(itemId);
            $('input[name="item_name"]').val(itemName);
            $('input[name="unit_id"]').val(unitId);
            $('input[name="unit_name"]').val(unitName);
            $('input[name="item_cost"]').val(itemCost);

            resetFormFields();
        });
    });
</script>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '{{ route('getCategories') }}', 
            dataType: 'json',
            success: function (response) {
                var select = $('#categorySelect');
                select.empty();
                select.append('<option disabled selected>Select</option>');
                $.each(response.categories, function (index, category) {
                    select.append('<option value="' + category.id + '">' + category.category_name + '</option>');
                });
            },
            error: function (error) {
                console.error('Error fetching categories:', error);
            }
        });

        $('.shop-btn').on('click', function () {
            var categoryId = $(this).data('category-id');
            var categoryName = $(this).closest('.rounded').find('h3').text();
            var selectedCategoryDropdown = $('#categorySelect');
            
            selectedCategoryDropdown.find('option[value="selectedCategory"]').remove();

            if (categoryId) {
                selectedCategoryDropdown.append('<option value="' + categoryId + '" selected>' + categoryName + '</option>');
            } else {
                selectedCategoryDropdown.append('<option disabled selected>Select</option>');
            }
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

<script>
    $(document).ready(function () {
        var currentRoute = window.location.pathname;
        if (currentRoute === '/dashboard') {
            AOS.init({
                easing: 'ease-in-out-sine',
                duration: 1000
            });
            const textElement = document.getElementById("typewriter-text");
            const textToType = "ensure a smooth procurement experience.";
            const typingSpeed = 100; 
            const delayBetweenText = 2000;

            let charIndex = 0;
            let isTyping = true;

            function typeNextCharacter() {
                if (isTyping) {
                    if (charIndex < textToType.length) {
                        textElement.innerHTML += textToType.charAt(charIndex);
                        charIndex++;
                        setTimeout(typeNextCharacter, typingSpeed);
                    } else {
                        isTyping = false;
                        setTimeout(resetTypewriter, delayBetweenText);
                    }
                }
            }

            function resetTypewriter() {
                textElement.innerHTML = "";
                charIndex = 0;
                isTyping = true;
                typeNextCharacter();
            }

            typeNextCharacter();
        }
    });
</script>

<script>
    $(document).ready(function() {
    // Event handler for when the modal is shown
    $('#modal-userppmp').on('shown.bs.modal', function (e) {
        // Get the categories data from the button's data attribute
        var categoriesData = $(e.relatedTarget).data('categories');

        // Parse the JSON data
        var categories = JSON.parse(categoriesData);

        // Set the selected options in the <select> element
        $(this).find('select[name="ppmp_categories[]"]').val(categories).trigger('change.select2');
    });
});

</script>

</body>
</html>
