<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\User\UserController::class, 'index']);

Route::get('/pelaporan',  [\App\Http\Controllers\User\UserController::class, 'pelaporan'])->name('pelaporan');
Route::post('/pelaporan/kirim',  [\App\Http\Controllers\User\UserController::class, 'storePelaporan'])->name('pelaporan.store');
Route::get('/laporan/{who?}', [\App\Http\Controllers\User\UserController::class, 'laporan'])->name('pelaporan.laporan');
Route::get('/pelaporan-detail/{id_pelaporan}', [\App\Http\Controllers\User\UserController::class, 'detailPelaporan'])->name('pelaporan.detail');

Route::get('/login',  [\App\Http\Controllers\User\UserController::class, 'masuk']);


Route::prefix('admin')->group( function() {
    Route::middleware('isAdmin')->group( function() {
       Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

       Route::resource('/petugas', \App\Http\Controllers\Admin\PetugasController::class);

       Route::get('/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
       Route::post('/laporan-get', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan'])->name('laporan.get');
       Route::post('/laporan/export', [\App\Http\Controllers\Admin\LaporanController::class, 'export'])->name('laporan.export');
    });

    Route::middleware('isPetugas')->group( function() {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.logout');

        // Pelaporan
        Route::get('pelaporan/{status}', [\App\Http\Controllers\Admin\PelaporanController::class, 'index'])->name('pelaporan.index');
        Route::get('pelaporan/verif/{id_pelaporan}', [\App\Http\Controllers\Admin\PelaporanController::class, 'verif'])->name('pelaporan.verif');
        Route::get('pelaporan/show/{id_pelaporan}', [\App\Http\Controllers\Admin\PelaporanController::class, 'show'])->name('pelaporan.show');
        Route::delete('pelaporan/delete/{id_pelaporan}', [\App\Http\Controllers\Admin\PelaporanController::class, 'destroy'])->name('pelaporan.delete');

        // Tanggapan
        Route::post('tanggapan', [\App\Http\Controllers\Admin\TanggapanController::class, 'response'])->name('tanggapan');

     });

    Route::middleware(['isGuest'])->group(function () {
        Route::get('/login',  [\App\Http\Controllers\Admin\AdminController::class, 'masuk'])->name('admin.masuk');
        Route::post('/login/auth', [\App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'formLogin'])->name('admin.masuk');
        Route::post('/login', [\App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');
    });
});



// Route::get('/admin', function () {
//     return view('pages.admin.dashboard');
// });