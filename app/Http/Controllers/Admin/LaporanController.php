<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class LaporanController extends Controller
{
    public function index() {

        return view('pages.admin.laporan.index');
    }

    public function laporan(Request $request) {
        date_default_timezone_set('Asia/Bangkok');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $pelaporan = Pelaporan::query();

        if($date_from) {
            $pelaporan->where('tgl_pelaporan', '>=', $date_from ?? '2021-01-01 00:00:00')->where('tgl_pelaporan', '<=', $date_to . ' 23:59:59' ?? date('Y-m-d H:i:s'));
        }

        return view('pages.admin.laporan.index', [
            'pelaporan' => $pelaporan->get(),
            'from' => $date_from,
            'to' => $date_to,
        ]);
    }
    public function export(Request $request) {
        date_default_timezone_set('Asia/Bangkok');
    
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
    
        $pelaporan = Pelaporan::query();
    
        if($date_from) {
            $pelaporan->where('tgl_pelaporan', '>=', $date_from . ' ' . '00:00:00')->where('tgl_pelaporan', '<=', $date_to . ' 23:59:59' ?? date('Y-m-d H:i:s'));
        }
        
        $pdf = PDF::loadview('pages.admin.laporan.export',['pelaporan'=>$pelaporan->get()]);
        return $pdf->download('laporan.pdf');
    }
    

}