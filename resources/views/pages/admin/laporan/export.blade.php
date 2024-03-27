<!DOCTYPE html>
<html>

<head>
    <title>Laporan Keselamatan Kerja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
{{-- <body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Keselamatan Kerja</h4>
	</center> --}}

<body>

    <style>
    .page-break {
        page-break-after: always;
    }

    .text-center {
        text-align: center;
    }

    .text-header {
        font-size: 1.1rem;
    }

    .size2 {
        font-size: 1.4rem;
    }

    .border-bottom {
        border-bottom: 1px black solid;
    }

    .border {
        border: 2px block solid;
    }

    .border-top {
        border-top: 1px black solid;
    }

    .float-right {
        float: right;
    }

    .mt-4 {
        margin-top: 4px;
    }

    .mx-1 {
        margin: 1rem 0 1rem 0;
    }

    .mr-1 {
        margin-right: 1rem;
    }

    .mt-1 {
        margin-top: 1rem;
    }

    ml-2 {
        margin-left: 2rem;
    }

    .ml-min-5 {
        margin-left: -5px;
    }

    .text-uppercase {
        font: uppercase;
    }

    .d1 {
        font-size: 2rem;
    }

    .img {
        position: absolute;
    }

    .link {
        font-style: underline;
    }

    .text-desc {
        font-size: 14px;
    }

    .text-bold {
        font-style: bold;
    }

    .underline {
        text-decoration: underline;
    }

    table {
        font-family: Arial, Helvetica, sans-serif;
        color: #666;
        text-shadow: 1px 1px 0px #fff;
        background: #eaebec;
        border: #ccc 1px solid;
    }

    table th {
        padding: 10px 15px;
        border-left: 1px solid #e0e0e0;
        border-bottom: 1px solid #e0e0e0;
        background: #ededed;
    }

    table tr {
        text-align: center;
        padding-left: 20px;
    }

    table td {
        padding: 10px 15px;
        border-top: 1px solid #ffffff;
        border-bottom: 1px solid #e0e0e0;
        border-left: 1px solid #e0e0e0;
        background: #fafafa;
        background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
        background: -moz-linear-gradient(top, #fbfbfb, #fafafa);
    }

    .table-center {
        margin-left: auto;
        margin-right: auto;
    }

    .mb-1 {
        margin-bottom: 1rem;
    }
    </style>

    <hr class="border">

    <!-- content -->

    <div class="size2 text-center mb-1">LAPORAN SAFETY PERUSAHAAN</div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pelaporan</th>
                <th>Nama</th>
                <th>Nama Karyawan</th>
                <th>Status Karyawan</th>
                <th>Departemen</th>
                <th>Kategori Bahaya</th>
                <th>Isi Laporan</th>
                <th>Tanggal Kejadian</th>
                <th>Waktu Kejadian</th>
                <th>Lokasi Kejadian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelaporan as $k => $i)
            <tr>
                <td>{{ $k += 1 }}.</td>
                <td>{{ Carbon\Carbon::parse($i->tgl_pelaporan)->format('d-m-Y') }}</td>
                <td>{{ $i->user->name }}</td>
                <td>{{ $i->nama_karyawan }}</td>
                <td>{{ $i->status_karyawan }}</td>
                <td>{{ $i->departemen }}</td>
                <td>{{ $i->kategori_bahaya }}</td>
                <td>{{ $i->isi_laporan }}</td>
                <td>{{ Carbon\Carbon::parse($i->tgl_kejadian)->format('d-m-Y') }}</td>
                <td>{{ $i->waktu_kejadian }}</td>
                <td>{{ $i->lokasi_kejadian }}</td>
                <td>{{ $i->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>