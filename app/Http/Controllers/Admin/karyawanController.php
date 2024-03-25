<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\karyawan;

class karyawanController extends Controller
{
    public function index() {

        $karyawan = karyawan::all();

        return view('pages.admin.karyawan.index', compact('karyawan'));
    }

    public function show($nik) {

        $karyawan = karyawan::where('nik', $nik)->first();

        return view('pages.admin.karyawan.show', compact('karyawan'));
    }

     public function destroy(Request $request, $nik) {

        if($nik = 'nik') {
            $nik = $request->nik;
        }

        $karyawan = karyawan::find($nik);

        $karyawan->delete();

        if($request->ajax()) {
            return 'success';
        }

        return redirect()->route('karyawan.index');
    }
}