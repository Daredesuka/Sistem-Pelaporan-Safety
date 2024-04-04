<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    use HasFactory;

    protected $table = 'pelaporan';

    protected $primaryKey = 'id_pelaporan';

    protected $fillable = [
        'tgl_pelaporan',
        'nama_karyawan',
        'status_karyawan',
        'departemen',
        'kategori_bahaya',
        'isi_laporan',
        'tgl_kejadian',
        'lokasi_kejadian',
        'foto',
        'status',
    ];
}