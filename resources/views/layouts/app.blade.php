<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title') | Pelaporan Safety</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/iconk3.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @stack('prepend-style')
    @stack('addon-style')

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="/">Pelaporan Safety</a></h1>

            <nav id="navbar" class="navbar order-last order-lg-0 ">
                <ul>
                    <li><a class="nav-link scrollto {{ (request()->is('/pelaporan')) ? 'active' : '' }}"
                            href="{{ route('pelaporan')}}">Buat Laporan</a></li>
                    <li><a class="nav-link scrollto {{ (request()->is('pelaporan.laporan')) ? 'active' : '' }}"
                            href="{{ route('pelaporan.laporan', 'saya')}}">Laporan Saya</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    @yield('content')

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row justify-content-between">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Pelaporan Safety</h3>
                        <p>
                            PT. Younexa Inti Materials<br>
                            Web Safety<br>

                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Kontak</h4>
                        <ul>
                            <p>
                                <strong>Phone:</strong> +34 964 504 450<br>
                                <strong>Email:</strong> info@younexa<br>
                            </p>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto my-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span><a target="_blank">PT. Younexa Inti
                                Materials</a></span></strong>. Web Safety. 2024
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="https://www.younexa.com/en/nosotros" class="websites"><i class="fas fa-globe"></i></a>
                <a href="https://www.instagram.com/younexaofficial/" class="instagram"><i
                        class="bx bxl-instagram"></i></a>
                <a href="https://www.linkedin.com/company/younexaofficial/" class="linkedin"><i
                        class="bx bxl-linkedin"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @stack('prepend-script')
    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('addon-script')

</body>

</html>