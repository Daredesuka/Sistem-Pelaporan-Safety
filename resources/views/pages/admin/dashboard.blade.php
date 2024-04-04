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
                    <a href="{{ url('/admin/petugas') }}">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Petugas</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $petugas }}</span>
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
                <div class="col-12">
                    <a href="">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Grafik Total Laporan
                                            Bulanan</h5>
                                        <canvas class="embed-responsive-item" id="bulanChart"
                                            style="width: 100%; height: 400px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
$th = [];
$pelaporan_th = [];
foreach ($tahun as $row) {
    $th[] = $row->Tahun;
    $pelaporan_th[] = $row->pay_total;
}

$bl = [];
$pelaporan_bl = [];
foreach ($bulan as $row) {
    $bl[] = date("F", mktime(0, 0, 0, $row->Month, 1));
    $pelaporan_bl[] = $row->pay_total;
}
?>

@endsection
@push('addon-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"> </script>
<script>
// Grafik untuk laporan bulanan
var ctxBulan = document.getElementById('bulanChart').getContext('2d');
var bulanChart = new Chart(ctxBulan, {
    type: 'line', // Menggunakan grafik tipe line
    data: {
        labels: <?php echo json_encode($bl) ?>.map(month => month), // Menggunakan bulan sebagai label
        datasets: [{
            label: 'Laporan (Perbulan)',
            data: <?php echo json_encode($pelaporan_bl) ?>,
            borderColor: 'rgba(54, 162, 235, 1)', // Warna garis
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: false, // Memulai sumbu y dari nilai minimal data
                    min: 1,
                    max: 10 // Nilai maximal sumbu y
                }
            }]
        },
        plugins: {
            annotation: {
                annotations: [{
                    type: 'line',
                    mode: 'horizontal',
                    scaleID: 'y-axis-0',
                    value: 0,
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 2,
                    label: {
                        enabled: true,
                        content: 'Baseline' // Label untuk baseline
                    }
                }]
            }
        }
    }
});
</script>

@endpush