<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelaporan;
use App\Models\Tanggapan;

class TanggapanController extends Controller
{
    public function response(Request $request) {

        $pelaporan = Pelaporan::where('id_pelaporan', $request->id_pelaporan)->first();

        $tanggapan = Tanggapan::where('id_pelaporan', $request->id_pelaporan)->first();

        if($tanggapan) {
            $pelaporan->update(['status' => $request->status]);

            $tanggapan->update([
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan ?? '',
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);

            if($request->ajax()) {
                return 'success';
            }

            return redirect()->route('pelaporan.show', ['id_pelaporan' => $request->id_pelaporan, 'pelaporan' => $pelaporan, 'tanggapan' => $tanggapan])->with(['status' => 'Berhasil Ditanggapi!']);
        } else {
            $pelaporan->update(['status' => $request->status]);

            $tanggapan = Tanggapan::create([
                'id_pelaporan' => $request->id_pelaporan,
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan ?? '',
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);

            if($request->ajax()) {
                return 'success';
            }

            return redirect()->route('pelaporan.show', ['id_pelaporan' => $request->id_pelaporan, 'pelaporan' => $pelaporan, 'tanggapan' => $tanggapan])->with(['status' => 'Berhasil Ditanggapi!']);
        }
    }
}