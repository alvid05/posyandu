<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Home | Posyandu</title>


    <!--  Social tags      -->
    <meta name="keywords"
        content="impact design system, design system, login, form, table, tables, calendar, card, cards, navbar, modal, icons, icons, map, chat, carousel, menu, datepicker, gallery, slider, date, sidebar, social, dropdown, search, tab, nav, footer, date picker, forms, tabs, time, button, select, input, timeline, cart, car, fullcalendar, about us, invoice, account, chat, log in, blog, profile, portfolio, landing page, ecommerce, shop, landing, register, app, contact, one page, sign up, signup, store, bootstrap 4, bootstrap4, dashboard, bootstrap 4 dashboard, bootstrap 4 design, bootstrap 4 system, bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, impact, impact ui kit, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit, impact dashboard">
    <meta name="description"
        content="Kick-Start Your Development With An Awesome Design System carefully designed for your online business showcase. It comes as a complete solution, with front pages and dashboard pages included.">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Impact Design System by Creative Tim">
    <meta itemprop="description"
        content="Kick-Start Your Development With An Awesome Design System carefully designed for your online business showcase. It comes as a complete solution, with front pages and dashboard pages included.">

    <!-- Favicon -->
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
    <style>
        .text-red {
            color: #E92327;
        }

        .mt-top {
            margin-top: 15rem;
        }

        .title {
            color: #E92327;
            font-weight: bold;
            font-size: 4rem;
        }
    </style>

</head>

<body class="bg-white">

    <!-- Main content -->
    <div class="main-content">
        <nav class="navbar navbar-top navbar-expand navbar-light bg-none border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center mr-md-auto ">
                        <li class="nav-item">
                            <!-- Sidenav toggler -->
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('dashboard/assets/img/daihatsu.png') }}" height="50"
                                    class="navbar-brand-img" alt="...">
                            </a>

                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="dropdown-item">
                                <span class="text-red font-weight-bold">Login</span>
                            </a>

                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('register') }}" class="dropdown-item">--}}
{{--                                <span class="text-red font-weight-bold">Register</span>--}}
{{--                            </a>--}}

{{--                        </li>--}}
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <div class="header bg-gradient-danger py-6 py-lg-7">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">@yield('form')</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--9 pb-5">
            <!-- Table -->
            <div class="row mt-top">
                <div class="col-lg-6 col-md-8 text-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('dashboard/assets/img/banner.jpeg') }}" height="450"
                            class="navbar-brand-img" alt="...">
                    </a>
                </div>
                <div class="col-lg-6">
                    <h1 class="title">Selamat Datang !</h1>
                    <p>Halaman ini merupakan platform Database Program dan Audit <br>
                        Kegiatan <i>Corporate Social and Responsibility</i> PT Astra Daihatsu Motor.</p>
                    <p><span style="font-weight: bold;">Addres :</span> <br>
                        Jl. Gaya Motor III No.5 Sunter 2 Jakarta Utara <br>
                        Head Office - PT Astra Daihatsu Motor <br>
                        (021) 6510-300
                    </p> <br>
                    <p><span style="font-weight: bold;">Contact :</span> <br>
                        Corporate Social and Responsibility Department
                    </p>
                </div>
            </div>
        </div>
    </div>


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
</body>

</html>
