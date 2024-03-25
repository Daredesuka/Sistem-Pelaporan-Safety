@extends('layouts.admin')
@section('title', 'Karyawan')


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
                <h6 class="h2 text-white d-inline-block mb-0">Karyawan</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  {{-- <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Karyawan</a></li>
                  </ol> --}}
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
                <h3 class="mb-0">Data Karyawan</h3>
              </div>
              <!-- Light table -->
              <div class="table-responsive">
                <table class="table align-items-center table-flush" id="pelaporanTable">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col" class="sort" data-sort="no">No</th>
                      <th scope="col" class="sort" data-sort="no">NIK</th>
                      <th scope="col" class="sort" data-sort="name">Nama</th>
                      <th scope="col" class="sort" data-sort="username">username</th>
                      <th scope="col" class="sort" data-sort="tlp">No Telpon</th>
                      <th scope="col" class="sort" data-sort="action">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                      @foreach($karyawan as $k => $kar)

                      <tr>
                        <td class="budget">
                            <span class="text-sm">{{ $k += 1}}</span>
                        </td>
                        <td><span class="text-sm">{{ $kar->nik}}</span></td>
                        <td><span class="text-sm">{{ $kar->name}}</span></td>
                        <td><span class="text-sm">{{ $kar->username}}</span></td>
                        <td><span class="text-sm">{{ $kar->telp}}</span></td>
                        <td style="width: 100px;">
                            <a href="{{ route('karyawan.show', $kar->nik)}}" class="btn btn-sm btn-info">Detail</a>
                            <a href="#" data-nik="{{ $kar->nik }}" class="btn btn-sm btn-danger karyawanDelete">Hapus</a>
                        </td>
                      </tr>

                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- Card footer -->
              <div class="card-footer py-4">
                <nav aria-label="...">
                  <ul class="pagination justify-content-end mb-0">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1">
                        <i class="fas fa-angle-left"></i>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item active">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">
                        <i class="fas fa-angle-right"></i>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
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
    } );
</script>

<script>

    $(document).on('click', '#del', function(e) {
        let id = $(this).data('userId');
        console.log(id);
    });

    $(document).on('click', '.karyawanDelete', function (e) {
        e.preventDefault();
        let nik = $(this).data('nik');
        Swal.fire({
                title: 'Peringatan!',
                text: "Apakah Anda yakin akan menghapus Karyawan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: '{{ route("karyawan.destroy", "nik") }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "nik": nik,
                    },
                    success: function (response) {
                        if (response == 'success') {
                            Swal.fire({
                                title: 'Pemberitahuan!',
                                text: "Karyawan berhasil dihapus!",
                                icon: 'success',
                                confirmButtonColor: '#28B7B5',
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }else{
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function (data) {
                        Swal.fire({
                            title: 'Pemberitahuan!',
                            text: "Karyawan gagal dihapus!",
                            icon: 'error',
                            confirmButtonColor: '#28B7B5',
                            confirmButtonText: 'OK',
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Pemberitahuan!',
                    text: "Karyawan gagal dihapus!",
                    icon: 'error',
                    confirmButtonColor: '#28B7B5',
                    confirmButtonText: 'OK',
                });
            }
        });
    });



</script>
@endpush
