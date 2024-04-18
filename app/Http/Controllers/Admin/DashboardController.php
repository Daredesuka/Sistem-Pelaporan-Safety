<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Models\Petugas;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $data['pelaporan'] = Pelaporan::all()->count();
        $data['pending'] = Pelaporan::where('status', 'pending')->count();
        $data['proses'] = Pelaporan::where('status', 'proses')->count();
        $data['selesai'] = Pelaporan::where('status', 'selesai')->count();
        $data['petugas'] = Petugas::count(); // Menghitung jumlah 
        $data['tahun'] = DB::table("pelaporan")
            ->select(DB::raw('EXTRACT(YEAR FROM tgl_kejadian) AS Tahun, COUNT(id_pelaporan) as pay_total'))
            ->groupBy(DB::raw('EXTRACT(YEAR FROM tgl_kejadian)'))
            ->get(); // Menghitung jumlah pelaporan per tahun
        $data['bulan'] = DB::table("pelaporan")
            ->select(DB::raw('EXTRACT(MONTH FROM tgl_kejadian) AS Month, 
                             SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) AS pending,
                             SUM(CASE WHEN status = "proses" THEN 1 ELSE 0 END) AS proses,
                             SUM(CASE WHEN status = "selesai" THEN 1 ELSE 0 END) AS selesai'))
            ->orWhereNull('deleted_at')
            ->groupBy(DB::raw('EXTRACT(MONTH FROM tgl_kejadian)'))
            ->get();
            
        return view('pages.admin.dashboard', $data);
    }
    
}