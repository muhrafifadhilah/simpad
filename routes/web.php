<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');    
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Semua role bisa akses admin dashboard
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    // Gabungkan pegawai & psi, kecuali pegawai hanya untuk role psi
    Route::middleware(['role:psi,pegawai'])->group(function () {
        Route::resource('subjek_pajak', \App\Http\Controllers\SubjekPajakController::class);
        Route::get('subjek_pajak/cetak-kartu/{id}', [\App\Http\Controllers\SubjekPajakController::class, 'cetakKartu'])->name('subjek_pajak.cetak_kartu');
        Route::resource('objek_pajak', \App\Http\Controllers\ObjekPajakController::class);
        Route::resource('kecamatan', \App\Http\Controllers\KecamatanController::class);
        Route::resource('upt', \App\Http\Controllers\UptController::class);
        Route::get('upt/{id}/kecamatan', [\App\Http\Controllers\UptController::class, 'getKecamatan']);
        Route::resource('sptpd', \App\Http\Controllers\SptpdController::class);
        Route::get('sptpd/export-pdf', [\App\Http\Controllers\SptpdController::class, 'exportPdf'])->name('sptpd.export-pdf');
        Route::post('/dashboard/update-tax', [App\Http\Controllers\Admin\DashboardController::class, 'updateTaxData'])->middleware('auth');
        Route::resource('wp', App\Http\Controllers\WpController::class)->except(['show', 'edit', 'update', 'destroy']);
        Route::post('wp/cari-subjek', [App\Http\Controllers\WpController::class, 'cariSubjek'])->name('wp.cariSubjek');
    });

    // Hanya psi yang bisa akses pegawai
    Route::middleware(['role:psi'])->group(function () {
        Route::resource('pegawai', App\Http\Controllers\PegawaiController::class);
    });

    // Middleware untuk wp
    Route::middleware(['role:wp'])->group(function () {
        Route::get('/wp/sptpd', [App\Http\Controllers\WpDashboardController::class, 'sptpd'])->name('wp.sptpd');
    });
});

Route::get('/get-users', [App\Http\Controllers\UserController::class, 'index']);
