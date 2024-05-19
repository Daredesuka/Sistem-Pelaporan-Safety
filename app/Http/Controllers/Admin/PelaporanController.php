<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Models\Tanggapan;

class PelaporanController extends Controller
{
    public function index($status) {
        $pelaporan = Pelaporan::where('status', $status)->orderBy('tgl_pelaporan', 'desc')->get();
        
        return view('pages.admin.pelaporan.index', compact('pelaporan', 'status'));
    }

    public function verif($id_pelaporan){
        $pelaporan = Pelaporan::where('id_pelaporan', $id_pelaporan)->first();

        return view('pages.admin.pelaporan.verif', [
            'pelaporan' => $pelaporan,
        ]);
    }
    
    public function show($id_pelaporan) {
        $pelaporan = Pelaporan::where('id_pelaporan', $id_pelaporan)->first();

        $tanggapan = Tanggapan::where('id_pelaporan', $id_pelaporan)->first();

        return view('pages.admin.pelaporan.show', [
            'pelaporan' => $pelaporan,
            'tanggapan' => $tanggapan
        ]);
    }

    public function destroy(Request $request, $id_pelaporan) {

        if($id_pelaporan = 'id_pelaporan') {
            $id_pelaporan = $request->id_pelaporan;
        }

        $pelaporan = Pelaporan::find($id_pelaporan);

        $pelaporan->delete();

        if($request->ajax()) {
            return 'success';
        }

        return redirect()->route('pelaporan.index');
    }

}