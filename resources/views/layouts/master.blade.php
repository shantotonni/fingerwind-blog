<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/fabicon.png') }}" type="image/x-icon" />
    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- font-awesome Styles -->

    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.min.css') }}" />

   <!-- all css here -->

    <link rel="stylesheet" href="{{ asset('assets/css/web-theme/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/admin-theme/DataTables/jquery.dataTables.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/admin-theme/DataTables/extensions/dataTables.colVis.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/admin-theme/bootstrap-datepicker/datepicker3.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Script -->
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/web-theme/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/js/admin-theme/bootbox/bootbox-v4.4.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin-theme/multi-select/multiselect.min.js') }}"></script>

    <!-- datepicker Scripts -->
    <script src="{{ asset('assets/js/admin-theme/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>

    <!-- timepicker Scripts -->
    <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>


    <style>
        .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
             background-color: #064685;
        }

        .nav .open > a, .nav .open > a:focus, .nav .open > a:hover {
            background-color: #064685;
        }
    </style>

</head>

<body>

<div class="clearfix main-wrapper">

    <!-- left Sidebar -->
         @include('layouts.left_sidebar')
    <!-- END left Sidebar  -->

    <div class="main">

        <!-- right Top Navbar -->
            @include('layouts.right_top_navbar')
       <!--End right Top Navbar -->

        <!-- Content area START -->
            <div class="container-fluid content">
                @yield('content')
            </div>
        <!-- End Content area -->

        <!-- FOOTER AREA START -->
            @include('layouts.footer')
        <!-- END FOOTER AREA -->

    </div>
</div>




<!-- Scripts AREA START -->


<script src="{{ asset('assets/js/admin-theme/jquery.pjax.js') }}"></script>
<script src="{{ asset('assets/js/admin-theme/DataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/admin-theme/DataTables/extensions/ColVis/js/dataTables.colVis.min.js') }}"></script>
<script src="{{ asset('assets/js/admin-theme/DemoTableDynamic.js') }}"></script>
<script src="{{ asset('assets/js/admin-theme/jquery-validation/dist/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
    $.pjax.defaults.timeout = 50000
</script>
<!-- END Scripts AREA  -->



</body>
</html>
