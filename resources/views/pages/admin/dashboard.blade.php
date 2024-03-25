@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ url('/admin/pelaporan/0') }}" class="btn btn-sm btn-neutral">Baru</a>
                    <a href="{{ url('/admin/petugas') }}" class="btn btn-sm btn-neutral">Petugas</a>
                </div>
            </div>
            <!-- Card stats -->
            <!-- -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <a href="{{ url('/admin/laporan') }}">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Semua Laporan</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $pelaporan }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <a href="{{ url('/admin/pelaporan/proses') }}">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Diproses</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $proses }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div
                                            class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="fas fa-sync"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <a href="{{ url('/admin/pelaporan/selesai') }}">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Selesai</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $selesai }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <a href="{{ url('/admin/karyawan') }}">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Karyawan</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $karyawan }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection