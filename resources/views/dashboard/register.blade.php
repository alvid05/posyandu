<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Register | Posyandu</title>


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
            font-size: 3rem;
        }
    </style>

</head>

<body class="bg-white">

    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
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
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="dropdown-item">
                                <span class="text-red font-weight-bold">Register</span>
                            </a>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>

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
                <div class="col-lg-4">
                    <div class="card bg-grey border border-soft">

                        <div class="card-body px-lg-5 py-lg-5">

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>Gagal!</strong> Data gagal diinputkan, silahkan cek
                                        form kembali!</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('failed'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>Failed!</strong> {{ session('failed') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <h2 class="title text-center">Register</h2>
                            <form method="POST" action="{{ route('registering') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="username" class="form-label">Nama Lengkap </label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                        </div>
                                        <input name="username" class="form-control" placeholder="Nama Lengkap">
                                    </div>
                                    @error('username')
                                        <p class="text-warning small">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email </label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input name="email" class="form-control" placeholder="Email"
                                            type="email">
                                    </div>
                                    @error('email')
                                        <p class="text-warning small">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Password </label>
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input name="password" class="form-control" placeholder="Password"
                                            type="password">
                                    </div>
                                    @error('password')
                                        <p class="text-warning small">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Confirm Password </label>
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input name="confirm_password" class="form-control"
                                            placeholder="Confirm Password" type="password">
                                    </div>
                                    @error('confirm_password')
                                        <p class="text-warning small">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jenis_pilar" class="form-label">Jenis Pilar </label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-watch-time"></i></span>
                                        </div>
                                        <select name="jenis_pilar" id="jenis_pilar" class="form-control" required>
                                            <option selected hidden>Pilih Jenis Pilar</option>
                                            @foreach($kategori as $item)
                                                <option value="{{ $item->id }}" data-category-id="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('jenis_pilar')
                                    <p class="text-warning small">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="auditor" class="form-label">Pilih Auditor</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-watch-time"></i></span>
                                        </div>
                                        <select name="auditor" id="auditor" class="form-control" required>
                                            <option selected hidden>Pilih Auditor</option>
                                        </select>
                                    </div>
                                    @error('auditor')
                                    <p class="text-warning small">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nama_kelompok" class="form-label">Nama Kelompok </label>
                                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="ni ni-single-02"></i></span>
                                                </div>
                                                <input name="nama_kelompok" class="form-control"
                                                    placeholder="Nama Kelompok" required>
                                            </div>
                                            @error('nama_kelompok')
                                                <p class="text-warning small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="wilayah" class="form-label">Wilayah </label>
                                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="ni ni-map-big"></i></span>
                                                </div>
                                                <input name="wilayah" class="form-control" placeholder="Wilayah" required>
                                            </div>
                                            @error('wilayah')
                                                <p class="text-warning small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger mt-4">Register</button>
                                    <p class="small mt-2">Sudah memiliki akun? <a
                                            href="{{ route('login') }}">Login</a> Sekarang</p>
                                </div>
                            </form>
                        </div>
                    </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#jenis_pilar').change(function () {
                var selectedCategoryId = $(this).find(':selected').data('category-id');
                fetchAuditors(selectedCategoryId);
            });

            function fetchAuditors(categoryId) {
                $.ajax({
                    url: "{{ route('getAuditorsByCategory') }}",
                    type: 'GET',
                    data: { category_id: categoryId },
                    success: function (data) {
                        var auditorSelect = $('#auditor');
                        auditorSelect.empty();
                        auditorSelect.append('<option selected hidden>Pilih Auditor</option>');

                        $.each(data, function (key, value) {
                            auditorSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>
</body>

</html>
