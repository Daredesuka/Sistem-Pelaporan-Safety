@extends('layouts.admin')
@section('title', 'Petugas')


@push('addon-style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endpush
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Petugas</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0 d-flex justify-content-between">
                    <h3 class="mb-0">Data Pelaporan</h3>
                    <a href="{{ route('petugas.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah
                        Petugas</a>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="pelaporanTable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="no">No</th>
                                <th scope="col" class="sort" data-sort="name">Nama Petugas</th>
                                <th scope="col" class="sort" data-sort="username">username</th>
                                <th scope="col" class="sort" data-sort="tlp">No Telpon</th>
                                <th scope="col" class="sort" data-sort="role">Role</th>
                                <th scope="col" class="sort" data-sort="action">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($petugas as $k => $pet)

                            <tr>
                                <td class="budget">
                                    <span class="text-sm">{{ $k += 1}}</span>
                                </td>
                                <td><span class="text-sm">{{ $pet->nama_petugas}}</span></td>
                                <td><span class="text-sm">{{ $pet->username}}</span></td>
                                <td><span class="text-sm">{{ $pet->telp}}</span></td>
                                <td><span class="text-sm">{{ $pet->roles}}</span></td>
                                <td style="width: 100px;">
                                    <a href="{{ route('petugas.edit', $pet->id_petugas)}}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <a href="#" data-id_petugas="{{ $pet->id_petugas }}"
                                        class="btn btn-sm btn-danger petugasDelete">Hapus</a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    <nav aria-label="...">
                    </nav>
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

$(document).on('click', '.petugasDelete', function(e) {
    e.preventDefault();
    let id_petugas = $(this).data('id_petugas');
    Swal.fire({
        title: 'Peringatan!',
        text: "Apakah Anda yakin akan menghapus petugas?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28B7B5',
        confirmButtonText: 'OK',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: '{{ route("petugas.destroy", "id_petugas") }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_petugas": id_petugas,
                },
                success: function(response) {
                    if (response == 'success') {
                        Swal.fire({
                            title: 'Pemberitahuan!',
                            text: "Petugas berhasil dihapus!",
                            icon: 'success',
                            confirmButtonColor: '#28B7B5',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            } else {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(data) {
                    Swal.fire({
                        title: 'Pemberitahuan!',
                        text: "Petugas gagal dihapus!",
                        icon: 'error',
                        confirmButtonColor: '#28B7B5',
                        confirmButtonText: 'OK',
                    });
                }
            });
        } else {
            Swal.fire({
                title: 'Pemberitahuan!',
                text: "Petugas gagal dihapus!",
                icon: 'error',
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',
            });
        }
    });
});
</script>
@endpush