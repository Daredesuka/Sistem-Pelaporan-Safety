<!DOCTYPE html>
<html>

<head>
    <title>Laporan Keselamatan Kerja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    @page {
        size: A4 landscape;
    }

    body {
        font-size: 10pt;
        /* Ukuran font default */
    }

    .table {
        font-size: 9pt;
        /* Ukuran font tabel */
        background-color: #f5f5f5;
        /* Warna latar belakang tabel */
        border-collapse: collapse;
        /* Menggabungkan garis pembatas */
        width: 100%;
    }

    .table th {
        padding: 8px;
        border: 1px solid #dddddd;
        /* Garis pembatas */
        background-color: #ededed;
        /* Warna latar belakang lebih gelap */
    }

    .table td {
        padding: 8px;
        border: 1px solid #dddddd;
        /* Garis pembatas */
        background-color: #fafafa;
    }

    .size2 {
        font-size: 16pt;
        /* Ukuran font judul */
    }

    .text-center {
        text-align: center;
    }

    .mb-1 {
        margin-bottom: 10px;
        /* Margin antar elemen */
    }
    </style>
</head>

<body>

    <!-- content -->
    <div class="size2 text-center mb-1">LAPORAN SAFETY PERUSAHAAN</div>

    <hr class="border">

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pelaporan</th>
                <th>Nama Karyawan</th>
                <th>Status Karyawan</th>
                <th>Departemen</th>
                <th>Kategori Bahaya</th>
                <th>Isi Laporan</th>
                <th>Tanggal Kejadian</th>
                <th>Lokasi Kejadian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelaporan as $k => $i)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($i->tgl_pelaporan)->format('d-m-Y') }}</td>
                <td>{{ $i->nama_karyawan }}</td>
                <td>{{ $i->status_karyawan }}</td>
                <td>{{ $i->departemen }}</td>
                <td>{{ $i->kategori_bahaya }}</td>
                <td>{{ $i->isi_laporan }}</td>
                <td>{{ \Carbon\Carbon::parse($i->tgl_kejadian)->format('d-m-Y') }}</td>
                <td>{{ $i->lokasi_kejadian }}</td>
                <td>{{ $i->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr class="border">

</body>

</html>