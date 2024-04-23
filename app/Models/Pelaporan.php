<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelaporan extends Model
{
    use HasFactory, SoftDeletes;

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
    protected $dates = ['deleted_at'];

    protected static function booted()
    {
        static::deleting(function ($pelaporan) {
            $pelaporan->status = 'terhapus';
            $pelaporan->save();
        });
    }
}