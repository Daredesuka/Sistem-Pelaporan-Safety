@extends('layouts.admin')
@section('title', 'Edit Petugas')


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
                    <h6 class="h2 text-white d-inline-block mb-0">Edit Petugas</h6>
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
        <div class="col-xl-6 order-xl-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('petugas.update', $petugas->id_petugas)}} " method="POST">
                        @csrf
                        @method('PATCH')
                        <!-- Petugas -->

                        <div class="form-group">
                            <label class="form-control-label">Nama Petugas</label>
                            <input type="text" value="{{ $petugas->nama_petugas}}" class="form-control"
                                name="nama_petugas" id="nama_petugas" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Username</label>
                            <input type="text" value="{{ $petugas->username}}" class="form-control" name="username"
                                id="username" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="abaikan jika tidak merubah password">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">No Telpon</label>
                            <input type="text" value="{{ $petugas->telp}}" class="form-control" name="telp" id="telp"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Roles</label>
                            <select name="roles" id="roles" class="custom-select" required>
                                @if ($petugas->roles == 'admin')
                                <option selected value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                                @else
                                <option value="admin">Admin</option>
                                <option selected value="petugas">Petugas</option>
                                @endif
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
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
@if (session()->has('status'))
<script>
Swal.fire({
    title: 'Pemberitahuan!',
    text: "{{ Session::get('status') }}",
    icon: 'success',
    confirmButtonColor: '#28B7B5',
    confirmButtonText: 'OK',
});
</script>
@endif
@endpush