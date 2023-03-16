<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthC;
use App\Http\Controllers\ApiC;
use App\Http\Controllers\PetugasC;
use App\Http\Controllers\SiswaC;
use App\Http\Controllers\KelasC;
use App\Http\Controllers\SppC;
use App\Http\Controllers\PembayaranC;
use App\Http\Controllers\PageC;
use App\Http\Controllers\AkunC;
use App\Http\Controllers\NotifikasiC;

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

Route::get('/profil/siswa/{nisn}', [SiswaC::class, 'show'])->middleware(['role:petugas,admin']);

Route::middleware('auth')->group(function () {
    Route::get('/', [PageC::class, 'dashSiswa'])->name('sis.dash');
    Route::prefix('siswa')->group(function () {
        Route::get('/profil/{nisn}', [SiswaC::class, 'show'])->name('sis.profil');
        Route::view('/pengaturan', 'siswa.pengaturan')->name('sis.edit');
        Route::post('/pengaturan', [SiswaC::class, 'update']);
    });
});

Route::prefix('auth')->group(function () {
    Route::view('/login', 'auth.login')->middleware('guest:petugas')->name('login');
    Route::post('/login', [AuthC::class, 'login']);
    Route::get('/logout', [AuthC::class, 'logout'])->name('logout');
});

Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [PageC::class, 'dashAdmin'])->middleware('role:admin,petugas')->name('admin.dash');
    Route::resources([
        'notifikasi' => NotifikasiC::class,
        'petugas' => PetugasC::class,
        'siswa' => SiswaC::class,
        'kelas' => KelasC::class,
        'spp' => SppC::class
    ]);
});
Route::middleware(['role:petugas'])->prefix('petugas')->group(function () {
    Route::get('/', [PageC::class, 'dashPetugas'])->name('petugas.dash');
});

Route::prefix('pembayaran')->group(function () {
    Route::middleware('role:petugas,admin')->group(function () {
        Route::get('/siswa', [PembayaranC::class, 'siswa']);
        Route::get('/entri', [PembayaranC::class, 'entri'])->name('pby.entri');
        Route::post('/entriBayar', [PembayaranC::class, 'bayar'])->name('pby.entri-post');
        Route::get('/history/{id}', [PembayaranC::class, 'history'])->name('pby.history');
    });
    Route::get('/history', [PembayaranC::class, 'siswaHistory'])->name('pby.siswa.history');
});

Route::prefix('api')->group(function () {
    Route::get('/test', [ApiC::class, 'tes']);
    Route::get('/siswa-list', [ApiC::class, 'siswa']);
    Route::get('/chart-pby', [ApiC::class, 'chartPby']);
    Route::get('/chart-sws', [ApiC::class, 'chartSws']);
});