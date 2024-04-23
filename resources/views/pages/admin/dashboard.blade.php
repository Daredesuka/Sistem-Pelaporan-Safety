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
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="{{ url('/admin/pelaporan/pending') }}">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pending</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $pending }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
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
@endsection

@push('addon-script')

@if(isset($bulan) && !empty($bulan))
@foreach ($bulan as $row)
<?php
    $bl[] = date("F", mktime(0, 0, 0, $row->Month, 1));
    $pelaporan_bl[] = ($row->pay_total ?? 0) + ($row->pending ?? 0) + ($row->proses ?? 0) + ($row->selesai ?? 0); 
    $pending_bl[] = $row->pending ?? 0; 
    $proses_bl[] = $row->proses ?? 0; 
    $selesai_bl[] = $row->selesai ?? 0; 
    ?>
@endforeach
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"> </script>
<script>
var ctxBulan = document.getElementById('bulanChart').getContext('2d');
var bulanChart = new Chart(ctxBulan, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($bl ?? []) ?>.map(month => month),
        datasets: [{
                label: 'Pending',
                data: <?php echo json_encode($pending_bl ?? []) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Diproses',
                data: <?php echo json_encode($proses_bl ?? []) ?>,
                backgroundColor: 'rgba(255, 206, 86, 0.5)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            },
            {
                label: 'Selesai',
                data: <?php echo json_encode($selesai_bl ?? []) ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        scales: {
            xAxes: [{
                stacked: true, // Menggunakan sumbu x sebagai stacked
                ticks: {
                    beginAtZero: true, // Memulai sumbu x dari nilai minimal data
                    stepSize: 2 // Menetapkan langkah sumbu x
                }
            }],
            yAxes: [{
                stacked: true, // Menggunakan sumbu y sebagai stacked
                ticks: {
                    beginAtZero: true, // Memulai sumbu y dari nilai minimal data
                    stepSize: 2 // Menetapkan langkah sumbu x
                }
            }]
        }
    }
});
</script>
@endpush