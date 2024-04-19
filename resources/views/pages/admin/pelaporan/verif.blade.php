@extends('layouts.admin')
@section('title', 'Verifikasi dan Validasi Pelaporan')

@push('addon-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endpush

@section('content')

<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Verifikasi dan Validasi Laporan</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6 overflow-hidden">
    <div class="row">
        <div class="col-xl-12 order-xl-1 overflow-hidden">
            <div class="card">
                <div class="table-responsive">
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <h3>Data Pelaporan</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID Pelaporan</th>
                                    <td>:</td>
                                    <td>{{ $pelaporan->id_pelaporan }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pelaporan</th>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($pelaporan->tgl_pelaporan)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Karyawan</th>
                                    <td>:</td>
                                    <td>{{ $pelaporan->nama_karyawan }}</td>
                                </tr>
                                <tr>
                                    <th>Status Karyawan</th>
                                    <td>:</td>
                                    <td>{{ $pelaporan->status_karyawan }}</td>
                                </tr>
                                <tr>
                                    <th>Departemen</th>
                                    <td>:</td>
                                    <td>{{ $pelaporan->departemen }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori Bahaya</th>
                                    <td>:</td>
                                    <td>{{ $pelaporan->kategori_bahaya }}</td>
                                </tr>
                                <tr>
                                    <th>Isi Laporan</th>
                                    <td>:</td>
                                    <td>{{ $pelaporan->isi_laporan }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal dan Waktu Kejadian</th>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($pelaporan->tgl_kejadian)->format('d-m-Y, H:m') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>
                                        @if($pelaporan->status == 'pending')
                                        <span class="text-sm badge badge-danger">Pending</span>
                                        @elseif($pelaporan->status == 'proses')
                                        <span class="text-sm badge badge-warning">Proses</span>
                                        @else
                                        <span class="text-sm badge badge-success">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Lokasi Kejadian</th>
                                    <td>:</td>
                                    <td>{{ $pelaporan->lokasi_kejadian }}</td>
                                </tr>
                                <tr>
                                    <th>Foto Kejadian</th>
                                    <td>:</td>
                                    <td><a href="{{ Storage::url($pelaporan->foto) }}" class="popup-image">
                                            <img src="{{ Storage::url($pelaporan->foto) }}" class="card-img"
                                                style="width: 200px;"></td>
                                </tr>
                                <tr>
                                    <th>Verifikasi dan Validasi</th>
                                    <td>:</td>
                                    <td>
                                        <a href="#" data-id_pelaporan="{{ $pelaporan->id_pelaporan }}"
                                            class="btn btn-primary pelaporan">Verifikasi</a>
                                        <a href="#" data-id_pelaporan="{{ $pelaporan->id_pelaporan }}"
                                            class="btn btn-danger pelaporanDelete">Hapus</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#pelaporanTable').DataTable();
});
</script>

<script>
$(document).on('click', '#del', function(e) {
    let id = $(this).data('userId');
    console.log(id);
});

$(document).on('click', '.pelaporan', function(e) {
    e.preventDefault();
    let id_pelaporan = $(this).data('id_pelaporan');
    Swal.fire({
        title: 'Peringatan!',
        text: "Apakah Anda yakin akan memverifikasi pelaporan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28B7B5',
        confirmButtonText: 'OK',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: '{{ route("tanggapan") }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_pelaporan": id_pelaporan,
                    "status": "proses",
                    "tanggapan": ''
                },
                success: function(response) {
                    if (response == 'success') {
                        Swal.fire({
                            title: 'Pemberitahuan!',
                            text: "Pelaporan berhasil diverifikasi!",
                            icon: 'success',
                            confirmButtonColor: '#28B7B5',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.replace(document.referrer);
                            }
                        });
                    }
                },
                error: function(data) {
                    Swal.fire({
                        title: 'Pemberitahuan!',
                        text: "Pelaporan gagal diverifikasi!",
                        icon: 'error',
                        confirmButtonColor: '#28B7B5',
                        confirmButtonText: 'OK',
                    });
                }
            });
        } else {
            Swal.fire({
                title: 'Pemberitahuan!',
                text: "Pelaporan gagal diverifikasi!",
                icon: 'error',
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',
            });
        }
    });
});

$(document).on('click', '.pelaporanDelete', function(e) {
    e.preventDefault();
    let id_pelaporan = $(this).data('id_pelaporan');
    Swal.fire({
        title: 'Peringatan!',
        text: "Apakah Anda yakin akan menghapus pelaporan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28B7B5',
        confirmButtonText: 'OK',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: '{{ route("pelaporan.delete", "id_pelaporan") }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_pelaporan": id_pelaporan,
                },
                success: function(response) {
                    if (response == 'success') {
                        Swal.fire({
                            title: 'Pemberitahuan!',
                            text: "Pelaporan berhasil dihapus!",
                            icon: 'success',
                            confirmButtonColor: '#28B7B5',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.replace(document.referrer);
                            }
                        });
                    }
                },
                error: function(data) {
                    Swal.fire({
                        title: 'Pemberitahuan!',
                        text: "Pelaporan gagal dihapus!",
                        icon: 'error',
                        confirmButtonColor: '#28B7B5',
                        confirmButtonText: 'OK',
                    });
                }
            });
        } else {
            Swal.fire({
                title: 'Pemberitahuan!',
                text: "Pelaporan gagal dihapus!",
                icon: 'error',
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',
            });
        }
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script>
$(document).ready(function() {
    $('.popup-image').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });
});
</script>
@endpush