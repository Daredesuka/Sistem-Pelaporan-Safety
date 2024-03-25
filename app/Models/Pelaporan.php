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
        'nik',
        'judul_laporan',
        'status_karyawan',
        'departemen',
        'kategori_bahaya',
        'isi_laporan',
        'tgl_kejadian',
        'waktu_kejadian',
        'lokasi_kejadian',
        'foto',
        'status',
    ];

    public function user() {
        return $this->hasOne(karyawan::class, 'nik', 'nik');
    }
}