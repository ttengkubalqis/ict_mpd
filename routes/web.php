<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AdminLoanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route untuk Halaman Log Masuk
Route::get('/', function () {
    // Akan memanggil fail resources/views/auth/login.blade.php
    return view('auth.login'); 
})->name('login');

// Route untuk Papan Pemuka (Dashboard)
Route::get('/dashboard', function () {
    // Akan memanggil fail resources/views/dashboard.blade.php
    return view('dashboard'); 
})->name('dashboard');

// Tambah route ini untuk Senarai Aset
Route::get('/senarai-aset', function () {
    return view('assets.index');
})->name('assets.index');

// Tambah route ini untuk Senarai Permohonan
Route::get('/permohonan', function () {
    return view('applications.index');
})->name('applications.index');

// Tambah route ini untuk paparan borang Daftar Aset
Route::get('/senarai-aset/tambah', function () {
    return view('assets.create');
})->name('assets.create');

// Tambah route ini untuk paparan Detail Permohonan
// Kita guna {id} sebagai parameter laluan dinamik
Route::get('/permohonan/{id}', function ($id) {
    // Di alam nyata, anda akan query database: $permohonan = Permohonan::find($id);
    return view('applications.show', ['id' => $id]);
})->name('applications.show');

// Kumpulan route untuk Aset
Route::get('/senarai-aset', [AssetController::class, 'index'])->name('assets.index');
Route::get('/senarai-aset/tambah', [AssetController::class, 'create'])->name('assets.create');

// Route POST ini yang akan menerima data form dari create.blade.php
Route::post('/senarai-aset/simpan', [AssetController::class, 'store'])->name('assets.store');

// Route untuk paparan borang kemas kini
Route::get('/senarai-aset/{id}/kemaskini', [AssetController::class, 'edit'])->name('assets.edit');

// Route untuk proses simpan data kemas kini ke database
Route::put('/senarai-aset/{id}', [AssetController::class, 'update'])->name('assets.update');

// Route untuk proses hapus data aset
Route::delete('/senarai-aset/{id}', [AssetController::class, 'destroy'])->name('assets.destroy');

// Route untuk Pemohon
Route::get('/dashboard-pemohon', function () {
    return view('pemohon.dashboard');
})->name('pemohon.dashboard');

// Route untuk Permohonan Aset (POV Pemohon)
Route::get('/pemohon/mohon', [App\Http\Controllers\RequestController::class, 'create'])->name('pemohon.mohon');
Route::post('/pemohon/simpan', [App\Http\Controllers\RequestController::class, 'store'])->name('pemohon.simpan');

// Route untuk Senarai Permohonan (Admin)
// Tukar daripada '/senarai-permohonan' kepada '/permohonan'
Route::get('/permohonan', [AdminLoanController::class, 'index'])->name('admin.loans.index');

// Route untuk Admin Papar Butiran & Proses Kelulusan
Route::get('/permohonan/{id}', [AdminLoanController::class, 'show'])->name('admin.loans.show');
Route::put('/permohonan/{id}/kelulusan', [AdminLoanController::class, 'update'])->name('admin.loans.update');

// TAMBAH BARIS INI UNTUK PENGELUAR:
Route::put('/permohonan/{id}/pengeluaran', [AdminLoanController::class, 'updatePengeluaran'])->name('admin.loans.pengeluaran');

// Route untuk Admin mengesahkan Pemulangan Aset
Route::put('/permohonan/{id}/pemulangan', [App\Http\Controllers\AdminLoanController::class, 'updatePemulangan'])->name('admin.loans.pemulangan');