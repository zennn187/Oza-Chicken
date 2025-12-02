<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MatakuliahController;

// Route Dasar
Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

// Route Mahasiswa
Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

Route::get('/nama/{Oza}', function ($param1) {
    return 'Nama saya: ' . $param1;
});

Route::get('/nim/{param?}', function ($param1 = '') {
    return 'NIM saya: ' . $param1;
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});


Route::get('/matakuliah', [MatakuliahController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
Route::post('/question/respon', [QuestionController::class, 'store'])->name('question.respon');

Route::resource('user', UserController::class);


// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan.index');
//     Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('admin.pelanggan.create');
//     Route::post('/pelanggan', [PelangganController::class, 'store'])->name('admin.pelanggan.store');
//     Route::get('/pelanggan/{pelanggan}/edit', [PelangganController::class, 'edit'])->name('admin.pelanggan.edit');
//     Route::put('/pelanggan/{pelanggan}', [PelangganController::class, 'update'])->name('admin.pelanggan.update');
//     Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('admin.pelanggan.destroy');
// });

Route::resource(name: 'pelanggan', controller: PelangganController::class);

// Route Auth
Route::get('login', [AuthController::class, 'index'])->name('login.index');
Route::post('login', [AuthController::class, 'login'])->name('login');


