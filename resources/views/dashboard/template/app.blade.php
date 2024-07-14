<!--

=========================================================
* Impact Design System - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/impact-design-system
* Copyright 2010 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/impact-design-system/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title> @yield('title') - Posyandu</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">


    <!-- Favicon -->
    <link rel="icon" href="{{ asset('dashboard/assets/img/daihatsu.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('dashboard/assets/img/daihatsu.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
        type="text/css">

    <!-- Page plugins -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/fullcalendar/dist/fullcalendar.min.css') }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}"
        type="text/css">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/dashboard.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom.css') }}" type="text/css">
    @yield('css')

</head>

<body>


    <!-- Sidenav -->
    @include('dashboard.template.sidenav')
    <!-- Sidenav -->


    <!-- Main content -->
    <div class="main-content" id="panel">

        <!-- Topnav -->
        @include('dashboard.template.topnav')
        <!-- Topnav -->

        @yield('content')

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src=" {{ asset('dashboard/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src=" {{ asset('dashboard/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src=" {{ asset('dashboard/assets/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src=" {{ asset('dashboard/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src=" {{ asset('dashboard/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>

    <!-- Optional JS -->
    <script src=" {{ asset('dashboard/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src=" {{ asset('dashboard/assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>

    <!-- Argon JS -->
    <script src=" {{ asset('dashboard/assets/js/dashboard.js?v=1.2.0') }}"></script>
    <!-- Demo JS - remove this in your project -->
    <script src=" {{ asset('dashboard/assets/js/demo.min.js') }}"></script>
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    @yield('js')
</body>

</html>
