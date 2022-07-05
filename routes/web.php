<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => ['role:admin']], function () {
        // Bidang
        Route::resource('/bidang', App\Http\Controllers\BidangController::class);
        // Jenis Kegiatan
        Route::resource('/jenis-kegiatan', App\Http\Controllers\JenisKegiatanController::class);
        // Jenis Pelangaran
        Route::resource('/jenis-pelanggaran', App\Http\Controllers\JenisPelanggaranController::class);
        // Sangsi
        Route::resource('/sangsi', App\Http\Controllers\SangsiController::class);
        // User
        Route::resource('/user', App\Http\Controllers\UserController::class);
    });
    // Laporan
    Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/create', [App\Http\Controllers\LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan/store', [App\Http\Controllers\LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id}/edit', [App\Http\Controllers\LaporanController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{id}/update', [App\Http\Controllers\LaporanController::class, 'update'])->name('laporan.update');
    Route::get('/laporan/{id}/show', [App\Http\Controllers\LaporanController::class, 'show'])->name('laporan.show');
    // Pengaturan
    Route::get('/akun', [App\Http\Controllers\AkunController::class, 'index'])->name('akun.index');
    Route::post('/akun/update', [App\Http\Controllers\AkunController::class, 'update'])->name('akun.update');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
