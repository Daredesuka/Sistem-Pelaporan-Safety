<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Models\karyawan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $data['pelaporan'] = Pelaporan::all()->count();
        $data['proses'] = Pelaporan::where('status', 'proses')->count();
        $data['selesai'] = Pelaporan::where('status', 'selesai')->count();
        $data['karyawan'] = Karyawan::count(); // Menghitung jumlah karyawan
        $data['tahun'] = DB::table("pelaporan")
            ->select(DB::raw('EXTRACT(YEAR FROM tgl_kejadian) AS Tahun, COUNT(id_pelaporan) as pay_total'))
            ->groupBy(DB::raw('EXTRACT(YEAR FROM tgl_kejadian)'))
            ->get(); // Menghitung jumlah pelaporan per tahun
        $data['bulan'] = DB::table("pelaporan")
            ->select(DB::raw('EXTRACT(MONTH FROM tgl_kejadian) AS Month, COUNT(id_pelaporan) as pay_total'))
            ->groupBy(DB::raw('EXTRACT(MONTH FROM tgl_kejadian)'))
            ->get(); // Menghitung jumlah pelaporan per bulan
    
        return view('pages.admin.dashboard', $data);
    }
    
}