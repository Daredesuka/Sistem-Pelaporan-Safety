<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Models\karyawan;

class DashboardController extends Controller
{
    public function index() {
        return view('pages.admin.dashboard', [
            'pelaporan' => Pelaporan::count(),
            'proses' => Pelaporan::where('status', 'proses')->count(),
            'selesai' => Pelaporan::where('status', 'selesai')->count(),
            'karyawan' => karyawan::count(),
        ]);
    }
}