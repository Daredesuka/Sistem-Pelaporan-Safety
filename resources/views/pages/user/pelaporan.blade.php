@extends('layouts.app')

@section('title', 'Pelaporan')

@section('content')
<main id="main" class="martop">

    <section class="inner-page">
        <div class="container">
            <div class="title text-center mb-4">
                <h2 class="fw-bold">Layanan Pelaporan Keamanan dan Keselamatan Kerja</h2>
                <h4 class="fw-normal">Sampaikan laporan Anda langsung kepada perusahaan</h4>
                <h6 class="fw-normal">Dengan laporan ini, anda telah menyelamatkan orang-orang terdekat anda</h6>
                <h6 class="fw-bold">Safety YES, Accident NO</h6>
            </div>
            <div class="card card-responsive p-4 border-0 col-md-8 shadow rounded mx-auto">
                <form action="{{ route('pelaporan.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nama_karyawan" class="form-label">Nama Lengkap</label>
                        <input type="text" value="{{ old('nama_karyawan') }}" name="nama_karyawan" id="nama_karyawan"
                            placeholder="Ketik Nama Lengkap"
                            class="form-control @error('nama_karyawan') is-invalid @enderror" required>
                        @error('nama_karyawan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="status_karyawan" class="form-label">Status Karyawan</label>
                        <div class="input-group input-group-merge input-group-alternative" style="width: 100%;">
                            <select value="{{ old('status_karyawan') }}" name="status_karyawan" id="status_karyawan"
                                placeholder="Pilih Status Karyawan"
                                class="form-select @error('status_karyawann') is-invalid @enderror" required>
                                <option value="Pilih Status Karyawan">Pilih Status Karyawan</option>
                                <option value="Tetap">Tetap/Permanent</option>
                                <option value="Kontrak">Kontrak/Temporary</option>
                                <option value="Pihak Ketiga">Pihak Ketiga (Kontraktor/Vendor/Auditor dll) / Third Party
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="departemen" class="form-label">Departemen</label>
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                            <select value="{{ old('departemen') }}" name="departemen" id="departemen"
                                placeholder="Pilih Status Karyawan"
                                class="form-select @error('departemen') is-invalid @enderror" required>
                                <option value="">Pilih Departemen</option>
                                <option value="EHS">EHS</option>
                                <option value="Production">Production</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Supply Chain">Supply Chain/Warehouse</option>
                                <option value="Quality/R&D">Quality/R&D</option>
                                <option value="HR/IT/Purchasing/Finance/Sales">HR/IT/Purchasing/Finance/Sales</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="kategori_bahaya" class="form-label">Kategori Bahaya</label>
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                            <small class="text-muted d-block">* Contoh Tindakan Tidak Aman : Tidak memakai APD dengan
                                benar, bercanda saat bekerja, mengendarai forklift dengan kecepatan tinggi atau sambil
                                mengoperasikan HP,
                                Menggunakan alat kerja yang tidak sesuai fungsi/peruntukannya, tidak memegang handrail
                                saat menaiki/menuruni tangga dll</small>
                            <small class="text-muted d-block">* Contoh Kondisi Tidak Aman : APAR terhalang, kabel
                                listrik terkelupas, bahan kimia ditempatkan dalam botol bekas air minum, material yang
                                ditumpuk posisinya miring atau berada dijalur pejalan kaki,
                                lantai licin, dll</small>
                        </div>
                        <div>
                            <select value="{{ old('kategori_bahaya') }}" name="kategori_bahaya" id="kategori_bahaya"
                                placeholder="Pilih Kategori Bahaya"
                                class="form-select @error('kategori_bahaya') is-invalid @enderror" required>
                                <option value="">Pilih Kategori Bahaya</option>
                                <option value="Tindakan Tidak Aman">Tindakan Tidak Aman</option>
                                <option value="Kondisi Tidak Aman">Kondisi Tidak Aman</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="isi_laporan" class="form-label">Isi Laporan/Bahaya Yang Ditemukan</label>
                        <textarea name="isi_laporan" id="isi_laporan" placeholder="Ketik isi Laporan" rows="5"
                            class="form-control @error('isi_laporan') is-invalid @enderror"
                            required>{{ old('isi_laporan') }}</textarea>
                        @error('isi_laporan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tgl_kejadian" class="form-label">Tanggal Kejadian</label>
                        <input type="date" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian" id="tgl_kejadian"
                            placeholder="Tanggal Kejadian"
                            class="form-control @error('tgl_kejadian') is-invalid @enderror" required>
                        @error('tgl_kejadian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="waktu_kejadian" class="form-label">Waktu Kejadian</label>
                        <input type="time" value="{{ old('waktu_kejadian') }}" name="waktu_kejadian" id="waktu_kejadian"
                            placeholder="Waktu Kejadian"
                            class="form-control @error('waktu_kejadian') is-invalid @enderror" required min="{{ \Carbon\Carbon::now()->format('H:i') }}">
                        @error('waktu_kejadian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="lokasi_kejadian" class="form-label">Lokasi Kejadian</label>
                        <textarea name="lokasi_kejadian" id="lokasi_kejadian" placeholder="Ketik Lokasi Kejadian"
                            rows="3" class="form-control @error('lokasi_kejadian') is-invalid @enderror"
                            required>{{ old('lokasi_kejadian') }}</textarea>
                        @error('lokasi_kejadian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="foto" class="form-label">Foto Bukti</label>
                        <input type="file" name="foto" id="foto"
                            class="form-control @error('file') is-invalid @enderror" required>
                        @error('file')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">KIRIM</button>

                </form>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection

@push('addon-script')
@if (!auth('karyawan')->check())
<script>
Swal.fire({
    title: 'Peringatan!',
    text: "Anda harus login terlebih dahulu!",
    icon: 'warning',
    confirmButtonColor: '#28B7B5',
    confirmButtonText: 'Masuk',
    allowOutsideClick: false
}).then((result) => {
    if (result.isConfirmed) {
        window.location.href = '{{ route("user.masuk") }}';
    } else {
        window.location.href = '{{ route("user.masuk") }}';
    }
});
</script>
@elseif(auth('karyawan')->user()->email_verified_at == null && auth('karyawan')->user()->telp_verified_at == null)
<script>
Swal.fire({
    title: 'Peringatan!',
    text: "Akun belum diverifikasi!",
    icon: 'warning',
    confirmButtonColor: '#28B7B5',
    confirmButtonText: 'Ok',
    allowOutsideClick: false
}).then((result) => {
    if (result.isConfirmed) {
        window.location.href = '{{ route("user.masuk") }}';
    } else {
        window.location.href = '{{ route("user.masuk") }}';
    }
});
</script>
@endif

@if (session()->has('pelaporan'))
<script>
Swal.fire({
    title: 'Pemberitahuan!',
    text: '{{ session()->get("pelaporan") }}',
    icon: '{{ session()->get("type") }}',
    confirmButtonColor: '#28B7B5',
    confirmButtonText: 'OK',
});
</script>
@endif
@endpush