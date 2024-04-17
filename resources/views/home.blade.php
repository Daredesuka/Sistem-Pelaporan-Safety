@extends('layouts.apps')

@section('title', 'Home')

@section('content')
<!-- This -->
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <h1>Pelaporan Safety</h1>
        <a href="{{ route('pelaporan')}}" class="btn-get-started scrollto">Buat Laporan</a>
    </div>
</section>
<!-- End Hero -->

<main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-3 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bxs-megaphone"></i>
                                    <h4>Tulis Laporan</h4>
                                </div>
                            </div>
                            <div class="col-xl-3 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-analyse"></i>
                                    <h4>Proses Verifikasi</h4>
                                </div>
                            </div>
                            <div class="col-xl-3 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Tindak Lanjut</h4>
                                </div>
                            </div>
                            <div class="col-xl-3 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class='bx bx-check-circle'></i>
                                    <h4>Selesai</h4>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class='bx bx-list-check'></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $pelaporan }} "
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Semua Laporan</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <div class="count-box">
                        <i class='bx bx-time'></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $pending }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Pending</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <div class="count-box">
                        <i class='bx bx-loader'></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $proses }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Sedang Diproses</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class='bx bx-check-circle'></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $selesai }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Selesai</p>
                    </div>
                </div>

            </div>
        </div>
    </section><!-- End Counts Section -->

</main><!-- End #main -->

<!-- End This -->

@endsection