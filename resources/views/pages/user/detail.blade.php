@extends('layouts.app')

@section('title', 'Pelaporan')

@section('content')
<main id="main" class="martop">

    <section class="inner-page">
        <div class="container ">
            <!-- <div class="title text-center mb-5">
            <h3 class="fw-bold">Layanan Pelaporan Safety Perusahaan</h3>
            <h5 class="fw-normal">Sampaikan laporan Anda langsung kepada perusahaan</h5>
        </div> -->

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-responsive p-4 border-0 shadow rounded mx-auto">
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <h3>Data Pelapor</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nama Karyawan</td>
                                        <td>:</td>
                                        <td>{{ $pelaporan->nama_karyawan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Karyawan</td>
                                        <td>:</td>
                                        <td>{{ $pelaporan->status_karyawan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Departemen</td>
                                        <td>:</td>
                                        <td>{{ $pelaporan->departemen }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pelaporan</td>
                                        <td>:</td>
                                        <td>{{ \Carbon\Carbon::parse($pelaporan->tgl_pelaporan)->format('d-m-Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal dan Waktu Kejadian</td>
                                        <td>:</td>
                                        <td>{{ \Carbon\Carbon::parse($pelaporan->tgl_kejadian)->format('d-m-Y, H:i') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-responsive p-4 border-0 shadow rounded mx-auto text-center">
                        <img src="{{ Storage::url($pelaporan->foto) }}" alt="">
                        <h3>Status</h3>
                        <p>
                            @if($pelaporan->status == '0')
                            <span class="text-sm text-white p-1 bg-danger">Pending</span>
                            @elseif($pelaporan->status == 'proses')
                            <span class="text-sm text-white p-1 bg-warning">Proses</span>
                            @else
                            <span class="text-sm text-white p-1 bg-success">Selesai</span>
                            @endif
                        </p>
                        <p>{{ $pelaporan->isi_laporan }}</p>
                        <span class="text-sm badge badge-warning">Proses</span>
                    </div>
                </div>
            </div>



        </div>
    </section>

</main><!-- End #main -->
@endsection