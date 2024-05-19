@extends('layouts.app')

@section('title', 'Laporan')

@push('addon-style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endpush

@section('content')
<main id="main" class="martop">
    <section class="inner-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header border-0 bg-transparent">
                            <div class="title text-center mb-3">
                                <h1 class="fw-bold">Laporan Saya</h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-sm" id="pelaporanTable"
                                    style="background-color: #F6F9FC;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Karyawan</th>
                                            <th scope="col">Departemen</th>
                                            <th scope="col">Kategori Bahaya</th>
                                            <th scope="col">Isi Laporan</th>
                                            <th scope="col">Tanggal dan Waktu Kejadian</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tanggapan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @forelse($pelaporan as $key => $laporan)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $laporan->nama_karyawan }}</td>
                                            <td>{{ $laporan->departemen }}</td>
                                            <td>{{ $laporan->kategori_bahaya }}</td>
                                            <td>{{ $laporan->isi_laporan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($laporan->tgl_kejadian)->format('d F Y (H:i)') }}
                                            </td>
                                            <td>
                                                @if($laporan->status == 'pending')
                                                <span class="text-sm text-white p-1 bg-danger">Pending</span>
                                                @elseif($laporan->status == 'proses')
                                                <span class="text-sm text-white p-1 bg-warning">Proses</span>
                                                @else
                                                <span class="text-sm text-white p-1 bg-success">Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                $tanggapan = App\Models\Tanggapan::where('id_pelaporan',
                                                $laporan->id_pelaporan)->first();
                                                @endphp
                                                @if($tanggapan)
                                                {{ $tanggapan->tanggapan }}
                                                @else
                                                Laporan Belum Di Verifikasi
                                                @endif
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data yang tersedia.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('addon-script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#pelaporanTable').DataTable({
        "paging": true
    });
});
</script>
@endpush