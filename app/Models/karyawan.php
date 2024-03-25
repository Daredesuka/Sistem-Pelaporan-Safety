<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class karyawan extends Authenticatable
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $primaryKey = 'nik';

    public $incrementing = false;

    protected $fillable = [
        'nik',
        'name',
        'email',
        'email_verified_at',
        'username',
        'jenis_kelamin',
        'password',
        'telp',
        'alamat',
        'rt',
        'rw',
        'kode_pos',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
    ];

}