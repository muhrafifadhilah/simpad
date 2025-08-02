<?php

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

    // Route untuk role psi dan pegawai (tanpa CRUD wp dan pegawai)
    Route::middleware(['role:psi,pegawai'])->group(function () {
        Route::resource('subjek_pajak', \App\Http\Controllers\SubjekPajakController::class);
        Route::get('subjek_pajak/cetak-kartu/{id}', [\App\Http\Controllers\SubjekPajakController::class, 'cetakKartu'])->name('subjek_pajak.cetak_kartu');
        Route::get('subjek_pajak/wp-account/{id}', [\App\Http\Controllers\SubjekPajakController::class, 'getWpAccount'])->name('subjek_pajak.wp_account');
        Route::post('subjek_pajak/reset-wp-password/{id}', [\App\Http\Controllers\SubjekPajakController::class, 'resetWpPassword'])->name('subjek_pajak.reset_wp_password');
        Route::resource('objek_pajak', \App\Http\Controllers\ObjekPajakController::class);
        Route::resource('kecamatan', \App\Http\Controllers\KecamatanController::class);
        Route::resource('upt', \App\Http\Controllers\UptController::class);
        Route::get('upt/{id}/kecamatan', [\App\Http\Controllers\UptController::class, 'getKecamatan']);
        Route::get('sptpd/export-pdf', [\App\Http\Controllers\SptpdController::class, 'exportPdf'])->name('sptpd.export-pdf');
        Route::resource('sptpd', \App\Http\Controllers\SptpdController::class);
        Route::post('/dashboard/update-tax', [App\Http\Controllers\Admin\DashboardController::class, 'updateTaxData'])->middleware('auth');
    });

    // Middleware untuk wp (hanya dashboard dan sptpd)
    Route::middleware(['role:wp'])->group(function () {
        Route::get('/wp/dashboard', [App\Http\Controllers\WpDashboardController::class, 'index'])->name('wp.dashboard');
        Route::get('/wp/sptpd', [App\Http\Controllers\WpDashboardController::class, 'sptpd'])->name('wp.sptpd');
        Route::post('/wp/sptpd', [App\Http\Controllers\WpDashboardController::class, 'storeSptpd'])->name('wp.sptpd.store');
        Route::get('/wp/sptpd/{id}', [App\Http\Controllers\WpDashboardController::class, 'showSptpd'])->name('wp.sptpd.show');
        Route::get('/wp/sptpd/{id}/pdf', [App\Http\Controllers\WpDashboardController::class, 'printSptpdPdf'])->name('wp.sptpd.pdf');
        Route::post('/wp/sptpd/{id}/bayar', [App\Http\Controllers\WpDashboardController::class, 'bayarSptpd'])->name('wp.sptpd.bayar');
        Route::get('/wp/sptpd/{id}/bukti-bayar', [App\Http\Controllers\WpDashboardController::class, 'buktiBayar'])->name('wp.sptpd.bukti');
    });
});

Route::get('/get-users', [App\Http\Controllers\UserController::class, 'index']);
