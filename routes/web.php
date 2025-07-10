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
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Middleware untuk pegawai
    Route::middleware(['role:pegawai'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('IsPsi');
        Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
        Route::resource('subjek_pajak', \App\Http\Controllers\SubjekPajakController::class);
        Route::get('subjek_pajak/cetak-kartu/{id}', [\App\Http\Controllers\SubjekPajakController::class, 'cetakKartu'])->name('subjek_pajak.cetak_kartu');
        Route::resource('objek_pajak', \App\Http\Controllers\ObjekPajakController::class);
        Route::resource('kecamatan', \App\Http\Controllers\KecamatanController::class);
        Route::resource('upt', \App\Http\Controllers\UptController::class);
        Route::get('upt/{id}/kecamatan', [\App\Http\Controllers\UptController::class, 'getKecamatan']);
        Route::resource('sptpd', \App\Http\Controllers\SptpdController::class);
        Route::post('/dashboard/update-tax', [App\Http\Controllers\Admin\DashboardController::class, 'updateTaxData'])->middleware('auth');
        Route::resource('wp', App\Http\Controllers\WpController::class)->except(['show', 'edit', 'update', 'destroy']);
        Route::post('wp/cari-subjek', [App\Http\Controllers\WpController::class, 'cariSubjek'])->name('wp.cariSubjek');
    });

    // Middleware untuk psi (akses semua kecuali dashboard wp)
    Route::middleware(['role:psi'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('IsPsi');
        Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
        Route::resource('pegawai', App\Http\Controllers\PegawaiController::class);
        Route::resource('subjek_pajak', \App\Http\Controllers\SubjekPajakController::class);
        Route::get('subjek_pajak/cetak-kartu/{id}', [\App\Http\Controllers\SubjekPajakController::class, 'cetakKartu'])->name('subjek_pajak.cetak_kartu');
        Route::resource('objek_pajak', \App\Http\Controllers\ObjekPajakController::class);
        Route::resource('kecamatan', \App\Http\Controllers\KecamatanController::class);
        Route::resource('upt', \App\Http\Controllers\UptController::class);
        Route::get('upt/{id}/kecamatan', [\App\Http\Controllers\UptController::class, 'getKecamatan']);
        Route::resource('sptpd', \App\Http\Controllers\SptpdController::class);
        Route::post('/dashboard/update-tax', [App\Http\Controllers\Admin\DashboardController::class, 'updateTaxData'])->middleware('auth');
        Route::resource('wp', App\Http\Controllers\WpController::class)->except(['show', 'edit', 'update', 'destroy']);
        Route::post('wp/cari-subjek', [App\Http\Controllers\WpController::class, 'cariSubjek'])->name('wp.cariSubjek');
        // Tidak ada akses ke /wp/dashboard dan /wp/sptpd
    });

    // Middleware untuk wp
    Route::middleware(['role:wp'])->group(function () {
        Route::get('/wp/dashboard', [App\Http\Controllers\WpDashboardController::class, 'index'])->name('wp.dashboard');
        Route::get('/wp/sptpd', [App\Http\Controllers\WpDashboardController::class, 'sptpd'])->name('wp.sptpd');
    });
});

Route::get('/get-users', [App\Http\Controllers\UserController::class, 'index']);
