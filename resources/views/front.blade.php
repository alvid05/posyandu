@extends('frontend.template.app')
@section('title')
    Home
@endsection
@section('css')
    <style>
        .header-3-3 .modal-backdrop.show {
            background-color: #000;
            opacity: 0.6;
        }

        .header-3-3 .modal-item.modal {
            top: 2rem;
        }

        .header-3-3 .navbar {
            padding: 2rem 2rem;
        }

        .header-3-3 .navbar-light .navbar-nav .nav-link {
            font: 300 0.875rem/1.5rem Poppins, sans-serif;
            color: #8B9CAF;
            padding: 0rem 1.25rem 0rem 0rem;
            margin-right: 0;
            margin-left: 0;
        }

        .header-3-3 .navbar-light .navbar-nav .nav-link:hover {
            font: 500 0.875rem/1.5rem Poppins, sans-serif;
            color: #243142;
        }

        .header-3-3 .navbar-light .navbar-nav .active {
            position: relative;
            width: fit-content;
        }

        .header-3-3 .navbar-light .navbar-nav .active>.nav-link,
        .header-3-3 .navbar-light .navbar-nav .nav-link.active,
        .header-3-3 .navbar-light .navbar-nav .nav-link.show,
        .header-3-3 .navbar-light .navbar-nav .show>.nav-link {
            font-weight: 500;
        }

        .header-3-3 .navbar-light .navbar-toggler-icon {
            background-image: urlurl("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .header-3-3 .btn:focus,
        .header-3-3 .btn:active {
            outline: none !important;
        }

        .header-3-3 .btn-fill {
            font: 500 0.875rem/1.25rem Poppins, sans-serif;
            border: 1px solid #4E91F9;
            background-color: #4E91F9;
            border-radius: 999px;
            padding: 0.75rem 1.5rem;
            transition: 0.3s;
        }

        .header-3-3 .btn-fill:hover {
            background-color: #6DA4F9;
            border: 1px solid #6DA4F9;
        }

        .header-3-3 .btn-no-fill {
            font: 500 0.875rem/1.25rem Poppins, sans-serif;
            color: #8B9CAF;
            padding: 0.75rem 2rem;
        }

        .header-3-3 .btn-no-fill:hover {
            color: #243142;
        }

        .header-3-3 .modal-item .modal-dialog .modal-content {
            border-radius: 8px;
        }

        .header-3-3 .responsive li {
            padding: 1rem;
        }

        .header-3-3 .hr {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .header-3-3 .hero {
            padding: 4rem 2rem;
        }

        .header-3-3 .left-column {
            margin-bottom: 0.75rem;
            width: 100%;
        }

        .header-3-3 .title-text-big {
            font: 600 2.25rem / normal Poppins, sans-serif;
            margin-bottom: 1.25rem;
            color: #243142;
        }

        .header-3-3 .text-caption {
            font: 300 1rem/1.5rem Poppins, sans-serif;
            letter-spacing: 0.025em;
            color: #8B9CAF;
            margin-bottom: 5rem;
        }

        .header-3-3 .btn-get {
            font: 600 1rem/1.5rem Poppins, sans-serif;
            padding: 1rem 2rem;
            border-radius: 999px;
            border: 1px solid #4E91F9;
            background-color: #4E91F9;
            transition: 0.3s;
        }

        .header-3-3 .btn-get:hover {
            background-color: #6DA4F9;
            border: 1px solid #6DA4F9;
        }

        .header-3-3 .btn-outline {
            font: 400 1rem/1.5rem Poppins, sans-serif;
            padding: 1rem 1.5rem;
            border-radius: 999px;
            background-color: transparent;
            border: 1px solid #A6B1BE;
            color: #A6B1BE;
            transition: 0.3s;
        }

        .header-3-3 .btn-outline:hover {
            border: 1px solid #6DA4F9;
            color: #6DA4F9;
        }

        .header-3-3 .btn-outline:hover div path {
            fill: #6DA4F9;
        }

        .header-3-3 .btn-outline:hover div rect {
            stroke: #6DA4F9;
        }

        .header-3-3 .right-column {
            width: 100%;
        }

        .header-3-3 .hero-right {
            right: 2rem;
            bottom: 0;
        }

        .header-3-3 .card-outer {
            padding-left: 0;
            z-index: 1;
        }

        .header-3-3 .card {
            transition: 0.4s;
            top: 0px;
            left: 0px;
            background-color: #FFFFFF;
            padding: 1.25rem;
            border-radius: 0.75rem;
            width: 100%;
            margin-top: 2.5rem;
            box-shadow: -4px 4px 10px 0px rgba(224, 224, 224, 0.25);
        }

        .header-3-3 .card:hover {
            top: -3px;
            left: -3px;
            transition: 0.4s;
            box-shadow: -4px 8px 15px 0px rgba(167, 167, 167, 0.25);
        }

        .header-3-3 .card-name {
            font: 600 1rem/1.5rem Poppins, sans-serif;
            margin-bottom: 0.25rem;
        }

        .header-3-3 .card-job {
            font: 300 0.75rem/1rem Poppins, sans-serif;
            color: #aaa6a6;
            margin-bottom: 0;
        }

        .header-3-3 .card-price-left {
            font: 500 1rem/1.5rem Poppins, sans-serif;
            margin-bottom: 0.125rem;
            color: #1B8171;
        }

        .header-3-3 .card-caption {
            font: 300 0.75rem/1rem Poppins, sans-serif;
            color: #aaa6a6;
            margin-bottom: 0;
        }

        .header-3-3 .card-price-right {
            font: 500 1rem/1.5rem Poppins, sans-serif;
            margin-bottom: 0.125rem;
            color: #FF7468;
        }

        .header-3-3 .btn-hire {
            font: 600 1rem/1.5rem Poppins, sans-serif;
            padding: 0.75rem 4rem;
            border-radius: 0.75rem;
            margin-bottom: 0.125rem;
            border: 1px solid #4E91F9;
            background-color: #4E91F9;
            transition: 0.3s;
        }

        .header-3-3 .btn-hire:hover {
            background-color: #6DA4F9;
            border: 1px solid #6DA4F9;
        }

        .header-3-3 .form {
            border-radius: 999px;
            background-color: #eef4fd;
            box-sizing: border-box;
            font-size: 14px;
            padding: 0rem 1rem;
            padding-right: 0.5rem;
            outline: none;
        }

        .header-3-3 .form div input[type="text"] {
            background-color: #eef4fd;
            box-sizing: border-box;
            font-size: 14px;
            padding: 0rem 0.5rem;
            outline: none;
            width: 100%;
        }

        .header-3-3 .center-search {
            bottom: 0.5rem;
        }

        @media (min-width: 576px) {
            .header-3-3 .modal-item .modal-dialog {
                max-width: 95%;
                border-radius: 12px;
            }

            .header-3-3 .navbar {
                padding: 2rem;
            }

            .header-3-3 .title-text-big {
                font-size: 3rem;
                line-height: 1.2;
            }
        }

        @media (min-width: 768px) {
            .header-3-3 .navbar {
                padding: 2rem 4rem;
            }

            .header-3-3 .hr {
                padding-left: 4rem;
                padding-right: 4rem;
            }

            .header-3-3 .hero {
                padding: 4rem;
            }

            .header-3-3 .left-column {
                margin-bottom: 3rem;
            }

            .header-3-3 .hero-right {
                right: 4rem;
            }

            .header-3-3 .card {
                margin-left: auto;
                margin-top: 0;
            }
        }

        @media (min-width: 992px) {

            .header-3-3 .navbar-light .navbar-nav .active:before {
                content: "";
                position: absolute;
                margin-left: auto;
                margin-right: auto;
                left: 0;
                right: 0;
                text-align: center;
                bottom: 0;
                height: 0px;
                width: 80%;
                /* or 100px */
                border-bottom: 2px solid #4E91F9;
            }

            .header-3-3 .navbar {
                padding: 2rem 6rem;
            }

            .header-3-3 .navbar-light .navbar-nav .nav-link {
                padding: 0;
                margin-right: 1rem;
                margin-left: 1rem;
            }

            .header-3-3 .navbar-light .navbar-nav .active:before {
                width: 40%;
            }

            .header-3-3 .hr {
                padding-left: 6rem;
                padding-right: 6rem;
            }

            .header-3-3 .hero {
                padding: 4rem 6rem 5rem;
            }

            .header-3-3 .left-column {
                width: 50%;
                margin-bottom: 0;
            }

            .header-3-3 .title-text-big {
                font-size: 3.75rem;
                line-height: 1.25;
            }

            .header-3-3 .right-column {
                width: 50%;
            }

            .header-3-3 .hero-right {
                right: 6rem;
            }

            .header-3-3 .card-outer {
                padding-left: 4rem;
            }

            .header-3-3 .center-search {
                left: 48%;
                top: 50%;
                bottom: auto;
                transform: translate(-48%, -50%);
            }

            .header-3-3 .form {
                width: 340px;
            }
        }

        @media (max-width: 1023px) {
            .header-3-3 .form div input[type="text"] {
                width: 100%;
            }
        }
    </style>
@endsection
@section('content')
    <section class="h-100 w-100"
        style="
				box-sizing: border-box;
				position: relative;
				background-color: #ffffff;
			">
        <div class="bg-white header-3-3 container-xxl mx-auto p-0 position-relative"
            style="font-family: 'Poppins', sans-serif">
            <div class="hr">
                <hr
                    style="
							border-color: #F4F4F4;
							background-color: #F4F4F4;
							opacity: 1;
							margin: 0 !important;
						" />
            </div>

            <div>
                <div class="mx-auto d-flex flex-lg-row flex-column hero">
                    <!-- Left Column -->
                    <div
                        class="left-column flex-lg-grow-1 d-flex flex-column align-items-lg-start text-lg-start align-items-center text-center mt-2">
                        <h1 class="title-text-big">
                            Jasa Pembuatan<br class="d-lg-block d-none" />
                            <span style="color: #4E91F9">Website</span> <br class="d-lg-block d-none" />
                        </h1>
                        <p class="text-caption">
                            Mau buat <strong style="color: #4E91F9">Website</strong>
                            tapi masih bingung mulai darimana ? <br>
                            Kami akan menyesuaikan harga dengan kebutuhan yang kamu inginkan 😊 <br>
                        </p>
                        <div
                            class="d-flex flex-sm-row flex-column align-items-center mx-auto mx-lg-0 justify-content-center gap-3">
                            <a href="#" class="btn btn-get text-white d-inline-flex">Hubungi Kami</a>
                            <a href="#" class="btn btn-outline">
                                <div class="d-flex align-items-center">
                                    <svg class="me-2" width="26" height="26" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.9295 13L11.6668 10.158V15.842L15.9295 13ZM17.9175 13.2773L10.8515 17.988C10.8013 18.0214 10.743 18.0406 10.6828 18.0434C10.6225 18.0463 10.5627 18.0328 10.5095 18.0044C10.4563 17.9759 10.4119 17.9336 10.3809 17.8818C10.3499 17.8301 10.3335 17.771 10.3335 17.7107V8.28933C10.3335 8.22904 10.3499 8.16988 10.3809 8.11816C10.4119 8.06644 10.4563 8.0241 10.5095 7.99564C10.5627 7.96718 10.6225 7.95367 10.6828 7.95655C10.743 7.95943 10.8013 7.9786 10.8515 8.012L17.9175 12.7227C17.9631 12.7531 18.0006 12.7943 18.0265 12.8427C18.0524 12.8911 18.0659 12.9451 18.0659 13C18.0659 13.0549 18.0524 13.1089 18.0265 13.1573C18.0006 13.2057 17.9631 13.2469 17.9175 13.2773Z"
                                            fill="#A6B1BE" />
                                        <rect x="0.5" y="0.5" width="25" height="25" rx="12.5"
                                            stroke="#A6B1BE" />
                                    </svg>
                                    Lihat Portofolio
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="right-column d-flex justify-content-center justify-content-lg-start text-center pe-0 ">
                        <img class="position-absolute d-lg-block d-none hero-right mb-2"
                            src="{{ asset('front/images/code_laptop.jpg') }}" alt="" width="570"
                            height="484" />

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container pb-4 px-4">
            <div class="row text-center d-block pt-5 pb-md-4 ">
                <h1 style="font-family: 'Poppins', sans-serif">
                    Apa yang kamu butuhkan ?
                </h1>
                <p class="text-muted">
                    Berikut adalah layanan yang kami berikan untuk semua kebutuhan anda, silahkan
                    kontak kami jika berminat.
                </p>
            </div>
            <div class="row featurette">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col-md-12 ">
                        <div class="row ">
                            <div class="col-xl-3 col-lg-6">
                                <div class="card l-bg-blue-dark">
                                    <div class="card-statistic-3 p-4">
                                        <div class="card-icon card-icon-large">
                                            <i class="fas fa-code" aria-hidden="true"></i>
                                        </div>
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Pembuatan Website</h5>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    3,243
                                                </h2>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>12.5% <i class="fa fa-arrow-up"></i></span>
                                            </div>
                                        </div>
                                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 25%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card l-bg-cherry">
                                    <div class="card-statistic-3 p-4">
                                        <div class="card-icon card-icon-large">
                                            <i class="fas fa-palette"></i>
                                        </div>
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Desain Website</h5>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    15.07k
                                                </h2>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>9.23% <i class="fa fa-arrow-up"></i></span>
                                            </div>
                                        </div>
                                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                            <div class="progress-bar l-bg-green" role="progressbar" data-width="25%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 25%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card l-bg-green-dark">
                                    <div class="card-statistic-3 p-4">
                                        <div class="card-icon card-icon-large">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Optimasi Website</h5>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    578
                                                </h2>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>10% <i class="fa fa-arrow-up"></i></span>
                                            </div>
                                        </div>
                                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                            <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 25%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card l-bg-orange-dark">
                                    <div class="card-statistic-3 p-4">
                                        <div class="card-icon card-icon-large">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Mentoring</h5>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    $11.61k
                                                </h2>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>2.5% <i class="fa fa-arrow-up"></i></span>
                                            </div>
                                        </div>
                                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 25%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="h-100 w-100 bg-white" style="box-sizing: border-box;">
        <style scoped>
            .content-3-3 .btn:focus,
            .content-3-3 .btn:active {
                outline: none !important;
            }

            .content-3-3 {
                padding: 5rem 2rem;
            }

            .content-3-3 .img-hero {
                width: 100%;
                margin-bottom: 3rem;
            }

            .content-3-3 .right-column {
                width: 100%;
            }

            .content-3-3 .title-text {
                font: 600 1.875rem/2.25rem Poppins, sans-serif;
                margin-bottom: 2.5rem;
                letter-spacing: -0.025em;
            }

            .content-3-3 .title-caption {
                font: 500 1.5rem/2rem Poppins, sans-serif;
                margin-bottom: 1.25rem;
            }

            .content-3-3 .circle {
                font: 500 1.25rem/1.75rem Poppins, sans-serif;
                height: 3rem;
                width: 3rem;
                margin-bottom: 1.25rem;
                border-radius: 9999px;
                background-color: #4E91F9;
            }

            .content-3-3 .text-caption {
                font: 400 1rem/1.75rem Poppins, sans-serif;
                letter-spacing: 0.025em;
            }

            .content-3-3 .btn-learn {
                font: 600 1rem/1.5rem Poppins, sans-serif;
                padding: 1rem 2.5rem;
                background-color: #4E91F9;
                transition: 0.3s;
                letter-spacing: 0.025em;
                border-radius: 0.75rem;
            }

            .content-3-3 .btn-learn:hover {
                background-color: #4E91F9;
                transition: 0.3s;
            }

            @media (min-width: 768px) {
                .content-3-3 .title-text {
                    font: 600 2.25rem/2.5rem Poppins, sans-serif;
                }
            }

            @media (min-width: 992px) {
                .content-3-3 .img-hero {
                    width: 50%;
                    margin-bottom: 0;
                }

                .content-3-3 .right-column {
                    width: 50%;
                }

                .content-3-3 .circle {
                    margin-right: 1.25rem;
                    margin-bottom: 0;
                }
            }
        </style>
        <div class="content-3-3 container-xxl mx-auto position-relative" style="font-family: 'Poppins', sans-serif">
            <div class="d-flex flex-lg-row flex-column align-items-center">
                <!-- Left Column -->
                <div class="img-hero text-center justify-content-center d-flex">
                    <img id="hero" class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-1.png"
                        alt="" />
                </div>

                <!-- Right Column -->
                <div
                    class="right-column d-flex flex-column align-items-lg-start align-items-center text-lg-start text-center">
                    <h2 class="title-text text-dark">3 Keuntungan</h2>
                    <ul style="padding: 0; margin: 0">
                        <li class="list-unstyled" style="margin-bottom: 2rem">
                            <h4
                                class="title-caption text-dark d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                                <span class="circle text-light d-flex align-items-center justify-content-center">
                                    1
                                </span>
                                Terpercaya
                            </h4>
                            <p class="text-caption text-dark">
                                Kami sudah berpengalaman dengan banyak client<br class="d-sm-inline d-none" />
                                selama beberapa tahun.
                            </p>
                        </li>
                        <li class="list-unstyled" style="margin-bottom: 2rem">
                            <h4
                                class="title-caption text-dark d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                                <span class="circle text-light d-flex align-items-center justify-content-center">
                                    2
                                </span>
                                Tercepat
                            </h4>
                            <p class="text-caption text-dark">
                                Kami berusaha untuk menyelesaikan permintaan<br class="d-sm-inline d-none" />
                                sebelum masuk tanggal deadline.
                            </p>
                        </li>
                        <li class="list-unstyled" style="margin-bottom: 4rem">
                            <h4
                                class="title-caption text-dark d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                                <span class="circle text-light d-flex align-items-center justify-content-center">
                                    3
                                </span>
                                Termurah
                            </h4>
                            <p class="text-caption text-dark">
                                Kami menyediakan harga yang bersaing<br class="d-sm-inline d-none" />
                                sesuai dengan harga mahasiswa.
                            </p>
                        </li>
                    </ul>
                    <button class="btn btn-learn text-light">Lihat Lainnya</button>
                </div>
            </div>
        </div>
    </section>


    <main class=" container ">
        <div class="row text-center d-block pt-5 pb-md-4">
            <h1 class="my-3 title-line" style="font-family: 'Poppins', sans-serif">Portofolio</h1>
        </div>


        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

            {{-- @foreach ($posts as $post)
    
    <div class="col mb-2">
    <div class="card shadow-sm h-50" style="border-radius: 34px">
      <div class="post box-radius">
        <a href="{{route('blog.slug', $post->slug)}}">
          <figure class="post__image box-radius">
            <img class="box-radius" src="data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=" data-src="{{asset('front/images/HTML.png')}}"  alt="" width="800" height="554">
          </figure>
        </a>
      </div>
    
    </div>
    </div>
    
    @endforeach --}}

            <div class="col mb-2">
                <div class="card shadow-sm h-170" style="border-radius: 34px">
                    <div class="post box-radius">
                        <a href="#">
                            <figure class="post__image box-radius">
                                <img class="box-radius"
                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs="
                                    data-src="{{ asset('front/images/porto-eform.png') }}" alt="" width="800"
                                    height="554">
                            </figure>
                        </a>
                    </div>
                    <div class="card-body">
                        <h3 class="fs-5 fw-bolder text d-flex w-100">
                            <a href="#" class="text-decoration-none text-dark">Website E-Form Apps</a>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col mb-2">
                <div class="card shadow-sm h-170" style="border-radius: 34px">
                    <div class="post box-radius">
                        <a href="#">
                            <figure class="post__image box-radius">
                                <img class="box-radius"
                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs="
                                    data-src="{{ asset('front/images/portal2.png') }}" alt="" width="800"
                                    height="554">
                            </figure>
                        </a>
                    </div>
                    <div class="card-body">
                        <h3 class="fs-5 fw-bolder text d-flex w-100">
                            <a href="#" class="text-decoration-none text-dark">Website Portal Recipe
                                Mondelez</a>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col mb-2">
                <div class="card shadow-sm h-170" style="border-radius: 34px">
                    <div class="post">
                        <figure class="post__image">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                data-src="{{ asset('front/images/porto-lamdanet.png') }}" alt="" width="800"
                                height="554">
                        </figure>
                    </div>
                    <div class="card-body">
                        <h3 class="fs-5 fw-bolder text d-flex w-100">
                            <a href="#" class="text-decoration-none text-dark">Website company profile
                                lamdanet.net</a>
                        </h3>
                    </div>
                </div>
            </div>

        </div>

        {{-- Blog --}}
        <div class="title_lines mb-2 mt-4"><span class="fruitDays">Blog</span></div>


        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

            @foreach ($posts as $post)
                <div class="col mb-2">
                    <div class="card shadow-sm h-100" style="border-radius: 34px">
                        <div class="post box-radius">
                            <a href="{{ route('blog.slug', $post->slug) }}">
                                <figure class="post__image box-radius">
                                    <img class="box-radius"
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs="
                                        data-src="{{ asset('front/images/HTML.png') }}" alt="" width="800"
                                        height="554">
                                </figure>
                            </a>
                        </div>

                        <div class="card-body">
                            <h3 class="fs-5 fw-bolder text d-flex w-100">
                                <a href="{{ route('blog.slug', $post->slug) }}"
                                    class="text-decoration-none text-dark">{{ $post->title }}</a>
                            </h3>
                            <p class="card-text fs-6">
                                <small class="text-muted">{!! substr($post->content, 0, 140) !!} ...</small>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col mb-2">
                <div class="card shadow-sm h-100" style="border-radius: 34px">
                    <div class="post box-radius">
                        <a href="#">
                            <figure class="post__image box-radius">
                                <img class="box-radius"
                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs="
                                    data-src="{{ asset('front/images/HTML.png') }}" alt="" width="800"
                                    height="554">
                            </figure>
                        </a>
                    </div>

                    <div class="card-body">
                        <h3 class="fs-5 fw-bolder text d-flex w-100">
                            <a href="#" class="text-decoration-none text-dark">Tutorial Tailwind: Membuat
                                Card dengan Image Zoom-in Saat Hover</a>
                        </h3>
                        <p class="card-text text-muted fs-6">
                            <small>Di Tutorial Tailwind kali ini, kita akan belajar membuat komponen Card dengan
                                efek image zoom-in saat mouse hover.</small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col mb-2">
                <div class="card shadow-sm h-100" style="border-radius: 34px">
                    <div class="post">
                        <figure class="post__image">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                data-src="https://raw.githubusercontent.com/tutsplus/web-performance-enhancement-how-to-load-images-using-in-view.js/master/images/image-22.jpg"
                                alt="" width="800" height="554">
                        </figure>
                    </div>

                    <div class="card-body">
                        <h3 class="fs-5 fw-bolder text d-flex w-100">
                            Tutorial Tailwind: Membuat Card dengan Image Zoom-in Saat Hover
                        </h3>
                        <p class="card-text text-muted fs-6">
                            <small>Di Tutorial Tailwind kali ini, kita akan belajar membuat komponen Card dengan
                                efek image zoom-in saat mouse hover.</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <section class="sponsor-brands bg-light">
            <div class="container">
                <div class="row text-center d-block pt-5 pb-md-4">
                    <h1 class="my-3 title-line" style="font-family: 'Poppins', sans-serif">Client Kami</h1>
                </div>
                <div class="row brand">
                    <div class="col-md-3 col-6 text-center my-md-auto">
                        <img src="{{ asset('front/images/logo/mondelez.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-3 col-6 text-center my-md-auto">
                        <img src="{{ asset('front/images/logo/trac.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-3 col-6 text-center my-md-auto mt-5 mt-md-0">
                        <img src="{{ asset('front/images/logo/lamda.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-3 col-6 text-center my-md-auto mt-5 mt-md-0">
                        <img src="{{ asset('front/images/logo/tiram.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
