<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\VerifikasiEmailUntukRegistrasiPelaporankaryawan;
use App\Models\karyawan;
use App\Models\Pelaporan;
use App\Models\Petugas;
use App\Models\Province;
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
        $proses = Pelaporan::where('status', 'proses')->count();
        $selesai = Pelaporan::where('status', 'selesai')->count();

        return view('home', [
            'pelaporan' => $pelaporan,
            'proses' => $proses,
            'selesai' => $selesai,
        ]);
    }

    // public function tentang()
    // {
    //     return view('pages.user.about');
    // }

    public function pelaporan()
    {
        $pelaporan = Pelaporan::get();
        return view('pages.user.pelaporan', compact('pelaporan'));
    }

    public function masuk()
    {
        return view('pages.user.login');
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

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {

            $email = karyawan::where('email', $request->username)->first();

            if (!$email) {
                return redirect()->back()->with(['pesan' => 'Email tidak terdaftar']);
            }

            $password = Hash::check($request->password, $email->password);


            if (!$password) {
                return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
            }

            if (Auth::guard('karyawan')->attempt(['email' => $request->username, 'password' => $request->password])) {

                return redirect()->route('pelaporan');
            } else {

                return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
            }
        } else {

            $karyawan = karyawan::where('username', $request->username)->first();

            $petugas = Petugas::where('username', $request->username)->first();

            if ($karyawan) {
                $username = karyawan::where('username', $request->username)->first();

                if (!$username) {
                    return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
                }

                $password = Hash::check($request->password, $username->password);

                if (!$password) {
                    return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
                }

                if (Auth::guard('karyawan')->attempt(['username' => $request->username, 'password' => $request->password])) {

                    return redirect()->route('pelaporan');
                } else {

                    return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
                }
            } elseif ($petugas) {
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
    }

    public function register()
    {
        $provinces = Province::all();
        return view('pages.user.register', compact('provinces'));
    }

    public function register_post(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nik' => ['required', 'min:16', 'max:16', 'unique:karyawan'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:karyawan'],
            'username' => ['required', 'string', 'regex:/^\S*$/u', 'unique:karyawan', 'unique:petugas,username'],
            'jenis_kelamin' => ['required'],
            'password' => ['required', 'min:6'],
            'telp' => ['required', 'regex:/(08)[0-9]/'],
            'alamat' => ['required'],
            'rt' => ['required'],
            'rw' => ['required'],
            'kode_pos' => ['required'],
            'province_id' => ['required'],
            'regency_id' => ['required'],
            'district_id' => ['required'],
            'village_id' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        karyawan::create([
            'nik' => $data['nik'],
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => strtolower($data['username']),
            'jenis_kelamin' => $data['jenis_kelamin'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'alamat' => $data['alamat'],
            'email_verified_at' => Carbon::now(),
            'rt' => $data['rt'],
            'rw' => $data['rw'],
            'kode_pos' => $data['kode_pos'],
            'province_id' => $data['province_id'],
            'regency_id' => $data['regency_id'],
            'district_id' => $data['district_id'],
            'village_id' => $data['village_id'],
        ]);

        $karyawan = karyawan::where('email', $data['email'])->first();

        Auth::guard('karyawan')->login($karyawan);

        return redirect('/pelaporan');
    }

    public function logout()
    {
        Auth::guard('karyawan')->logout();

        return redirect('/login');
    }

    public function storePelaporan(Request $request)
    {
        if (!Auth::guard('karyawan')->check()) {
            return redirect()->back()->with(['pelaporan' => 'Login dibutuhkan!', 'type' => 'error']);
        } elseif (Auth::guard('karyawan')->user()->email_verified_at == null && Auth::guard('karyawan')->user()->telp_verified_at == null) {
            return redirect()->back()->with(['pelaporan' => 'Akun belum diverifikasi!', 'type' => 'error']);
        }

        $data = $request->all();

        $validate = Validator::make($data, [
            'judul_laporan' => ['required'],
            'status_karyawan' => ['required'],
            'departemen' => ['required'],
            'kategori_bahaya' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'waktu_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
            // 'id_kategori' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }


        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pelaporan', 'public');
        }

        date_default_timezone_set('Asia/Bangkok');

        $pelaporan = Pelaporan::create([
            'tgl_pelaporan' => date('Y-m-d h:i:s'),
            'nik' => Auth::guard('karyawan')->user()->nik,
            'judul_laporan' => $data['judul_laporan'],
            'status_karyawan' => $data['status_karyawan'],
            'departemen' => $data['departemen'],
            'kategori_bahaya' => $data['kategori_bahaya'],
            'isi_laporan' => $data['isi_laporan'],
            'tgl_kejadian' => $data['tgl_kejadian'],
            'waktu_kejadian' => $data['waktu_kejadian'],
            'lokasi_kejadian' => $data['lokasi_kejadian'],
            // 'id_kategori' => $data['id_kategori'],
            'foto' => $data['foto'] ?? 'assets/pelaporan/gambar.jpg',
            'status' => '0',
        ]);

        if ($pelaporan) {

            return redirect()->back()->with(['pelaporan' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {

            return redirect()->back()->with(['pelaporan' => 'Gagal terkirim!', 'type' => 'error']);
        }
    }

    public function laporan($who = '')
    {
        $terverifikasi = Pelaporan::where([['nik', Auth::guard('karyawan')->user()->nik], ['status', '!=', '0']])->get()->count();
        $proses = Pelaporan::where([['nik', Auth::guard('karyawan')->user()->nik], ['status', 'proses']])->get()->count();
        $selesai = Pelaporan::where([['nik', Auth::guard('karyawan')->user()->nik], ['status', 'selesai']])->get()->count();

        $hitung = [$terverifikasi, $proses, $selesai];

        if ($who == 'saya') {

            $pelaporan = Pelaporan::where('nik', Auth::guard('karyawan')->user()->nik)->orderBy('tgl_pelaporan', 'desc')->get();

            return view('pages.user.laporan', ['pelaporan' => $pelaporan, 'hitung' => $hitung, 'who' => $who]);
        } else {

            $pelaporan = Pelaporan::where('status', '!=', '0')->orderBy('tgl_pelaporan', 'desc')->get();

            return view('pages.user.laporan', ['pelaporan' => $pelaporan, 'hitung' => $hitung, 'who' => $who]);
        }
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
            'judul_laporan' => ['required'],
            'status_karyawan' => ['required'],
            'departemen' => ['required'],
            'kategori_bahaya' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'waktu_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
            // 'id_kategori' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pelaporan', 'public');
        }

        $pelaporan = Pelaporan::where('id_pelaporan', $id_pelaporan)->first();

        $pelaporan->update([
            'judul_laporan' => ['required'],
            'status_karyawan' => ['required'],
            'departemen' => ['required'],
            'kategori_bahaya' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'waktu_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
            // 'id_kategori' => $data['kategori_kejadian'],
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

    public function updatePassword(Request $request)
    {
        $data = $request->all();

        if (Auth::guard('karyawan')->user()->password == null) {
            $validate = Validator::make($data, [
                'password' => ['required', 'min:6', 'confirmed'],
            ]);
        } else {
            $validate = Validator::make($data, [
                'old_password' => ['required', 'min:6'],
                'password' => ['required', 'min:6', 'confirmed'],
            ]);
        }

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $nik = Auth::guard('karyawan')->user()->nik;

        $karyawan = karyawan::where('nik', $nik)->first();

        if (Auth::guard('karyawan')->user()->password == null) {
            $karyawan->password = Hash::make($data['password']);
            $karyawan->save();

            return redirect()->back()->with(['pesan' => 'Password berhasil diubah!', 'type' => 'success']);
        } elseif (Hash::check($data['old_password'], $karyawan->password)) {

            $karyawan->password = Hash::make($data['password']);
            $karyawan->save();

            return redirect()->back()->with(['pesan' => 'Password berhasil diubah!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['pesan' => 'Password lama salah!', 'type' => 'error']);
        }
    }

    public function ubah(Request $request, $what)
    {
        if ($what == 'email') {
            $karyawan = karyawan::where('nik', $request->nik)->first();

            $karyawan->email = $request->email;
            $karyawan->save();

            return 'success';
        } elseif ($what == 'telp') {

            $validate = Validator::make($request->all(), [
                'telp' => ['required', 'regex:/(08)[0-9]/'],
            ]);

            if ($validate->fails()) {
                return 'error';
            }

            $karyawan = karyawan::where('nik', $request->nik)->first();

            $karyawan->telp = $request->telp;
            $karyawan->save();

            return 'success';
        }
    }

    public function profil()
    {
        $nik = Auth::guard('karyawan')->user()->nik;

        $karyawan = karyawan::where('nik', $nik)->first();

        return view('user.profil', ['karyawan' => $karyawan]);
    }

    public function updateProfil(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;

        $data = $request->all();

        $validate = Validator::make($data, [
            'nik' => ['sometimes', 'required', 'min:16', 'max:16', Rule::unique('karyawan')->ignore($nik, 'nik')],
            'nama' => ['required', 'string'],
            'email' => ['sometimes', 'required', 'email', 'string', Rule::unique('karyawan')->ignore($nik, 'nik')],
            'username' => ['sometimes', 'required', 'string', 'regex:/^\S*$/u', Rule::unique('karyawan')->ignore($nik, 'nik'), 'unique:petugas,username'],
            'jenis_kelamin' => ['required'],
            'telp' => ['required', 'regex:/(08)[0-9]/'],
            'alamat' => ['required'],
            'rt' => ['required'],
            'rw' => ['required'],
            'kode_pos' => ['required'],
            'province_id' => ['required'],
            'regency_id' => ['required'],
            'district_id' => ['required'],
            'village_id' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $karyawan = karyawan::where('nik', $nik);

        $karyawan->update([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'username' => strtolower($data['username']),
            'jenis_kelamin' => $data['jenis_kelamin'],
            'telp' => $data['telp'],
            'alamat' => $data['alamat'],
            'rt' => $data['rt'],
            'rw' => $data['rw'],
            'kode_pos' => $data['kode_pos'],
            'province_id' => $data['province_id'],
            'regency_id' => $data['regency_id'],
            'district_id' => $data['district_id'],
            'village_id' => $data['village_id'],
        ]);
        return redirect()->back()->with(['pesan' => 'Profil berhasil diubah!', 'type' => 'success']);
    }
}