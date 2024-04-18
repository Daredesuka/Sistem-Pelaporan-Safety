<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pelaporan;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $pelaporan = Pelaporan::count();
        $pending = Pelaporan::where('status', 'pending')->count();
        $proses = Pelaporan::where('status', 'proses')->count();
        $selesai = Pelaporan::where('status', 'selesai')->count();

        return view('home', [
            'pelaporan' => $pelaporan,
            'pending' => $pending,
            'proses' => $proses,
            'selesai' => $selesai,
        ]);
    }

    public function pelaporan()
    {
        $pelaporan = Pelaporan::get();
        return view('pages.user.pelaporan', compact('pelaporan'));
    }

    public function masuk()
    {
        return view('pages.admin.login');
    }

    public function login(Request $request)
    {

        $data = $request->all();

        $validate = Validator::make($data, [
            'username' => ['required'],
            'password' => ['required']
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $petugas = Petugas::where('username', $request->username)->first();

        if ($petugas) {
                $username = Petugas::where('username', $request->username)->first();

                if (!$username) {
                    return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
                }

                $password = Hash::check($request->password, $username->password);

                if (!$password) {
                    return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
                }

                if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {

                    return redirect()->route('dashboard');
                } else {

                    return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
                }
            } else {
                return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
            }
        }

    public function logout()
    {
        Auth::guard('petugas')->logout();

        return redirect('/login');
    }

    public function storePelaporan(Request $request)
    {

        $data = $request->all();

        date_default_timezone_set('Asia/Bangkok');

        $validate = Validator::make($data, [
            'nama_karyawan' => ['required','min:3'],
            'status_karyawan' => ['required'],
            'departemen' => ['required'],
            'kategori_bahaya' => ['required'],
            'isi_laporan' => ['required','min:5'],
            'tgl_kejadian' => ['required', 'before_or_equal:'.now()->format('Y-M-d H:i:s')],
            'lokasi_kejadian' => ['required','min:5'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }


        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pelaporan', 'public');
        }

        date_default_timezone_set('Asia/Bangkok');

        $pelaporan = Pelaporan::create([
            'tgl_pelaporan' => date('Y-m-d H:i:s'),
            'nama_karyawan' => $data['nama_karyawan'],
            'status_karyawan' => $data['status_karyawan'],
            'departemen' => $data['departemen'],
            'kategori_bahaya' => $data['kategori_bahaya'],
            'isi_laporan' => $data['isi_laporan'],
            'tgl_kejadian' => $data['tgl_kejadian'],
            'lokasi_kejadian' => $data['lokasi_kejadian'],
            'foto' => $data['foto'] ?? 'assets/pelaporan/no-image.jpg',
            'status' => 'pending',
        ]);

        if ($pelaporan) {

            return redirect()->back()->with(['pelaporan' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {

            return redirect()->back()->with(['pelaporan' => 'Gagal terkirim!', 'type' => 'error']);
        }
    }

    public function laporan($who = '')
    {
    $terverifikasi = Pelaporan::where('status', '!=', 'pending')->get()->count();
    $proses = Pelaporan::where('status', 'proses')->get()->count();
    $selesai = Pelaporan::where('status', 'selesai')->get()->count();

    $hitung = [$terverifikasi, $proses, $selesai];

    if ($who == 'saya') {
        $pelaporan = Pelaporan::orderBy('tgl_pelaporan', 'desc')->get();
    } else {
        $pelaporan = Pelaporan::where('status', '!=', 'pending')->orderBy('tgl_pelaporan', 'desc')->get();
    }

    return view('pages.user.laporan', ['pelaporan' => $pelaporan, 'hitung' => $hitung, 'who' => $who]);
    }


    public function detailPelaporan($id_pelaporan)
    {
        $pelaporan = Pelaporan::where('id_pelaporan', $id_pelaporan)->first();

        return view('pages.user.detail', ['pelaporan' => $pelaporan]);
    }

    public function laporanEdit($id_pelaporan)
    {
        $pelaporan = Pelaporan::where('id_pelaporan', $id_pelaporan)->first();

        return view('user.edit', ['pelaporan' => $pelaporan]);
    }

    public function laporanUpdate(Request $request, $id_pelaporan)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_karyawan' => ['required'],
            'status_karyawan' => ['required'],
            'departemen' => ['required'],
            'kategori_bahaya' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pelaporan', 'public');
        } else {
            $data['foto'] = 'assets/pelaporan/no-image.jpg'; // Atur gambar default di sini
        }

        $pelaporan = Pelaporan::where('id_pelaporan', $id_pelaporan)->first();

        $pelaporan->update([
            'nama_karyawan' => ['required'],
            'status_karyawan' => ['required'],
            'departemen' => ['required'],
            'kategori_bahaya' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
            'foto' => $data['foto'] ?? $pelaporan->foto
        ]);

        return redirect()->route('pelaporan.detail', $id_pelaporan);
    }

    public function laporanDestroy(Request $request)
    {
        $pelaporan = Pelaporan::where('id_pelaporan', $request->id_pelaporan)->first();

        $pelaporan->delete();

        return 'success';
    }

    public function password()
    {
        return view('user.password');
    }

}