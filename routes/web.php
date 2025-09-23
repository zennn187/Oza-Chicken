<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

Route::get('/nama/{Oza}', function ($param1) {
    return 'Nama saya: '.$param1;
});

Route::get('/nim/{param?}', function ($param1 = '') {
    return 'NIM saya: '.$param1;
});

Route ::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/matakuliah', [MatakuliahController::class,'index']);



Route::get('/matakuliah', function () {
    return view('halaman-index-matakuliah');
});



