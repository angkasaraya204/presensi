<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PresensiController;

Route::get('/', function () {
    return redirect()->route('login');
});

// route::get('/registrasi',[LoginController::class,'registrasi'])->name('registrasi');
// route::post('/simpanregistrasi',[LoginController::class,'simpanregistrasi'])->name('simpanregistrasi');
route::get('/login',[LoginController::class,'halamanlogin'])->name('login');
route::post('/postlogin',[LoginController::class,'postlogin'])->name('postlogin');
route::get('/logout',[LoginController::class,'logout'])->name('logout');
route::get('/home',[HomeController::class,'index'])->name('home');  

Route::group(['middleware' => ['auth','ceklevel:admin']], function () {
    route::get('/rekap-presensi',[HomeController::class,'semuarekap'])->name('semua-rekap');
    route::get('/edit-rekap-presensi/{id}',[HomeController::class,'edit'])->name('edit-rekap');
    route::post('/edit-rekap-presensi/{id}',[HomeController::class,'update'])->name('ubah-rekap');
    route::delete('/hapus-rekap-presensi/{id}',[HomeController::class,'destroy'])->name('hapus-rekap');
    route::get('/filter-data-rekap/{tglawal?}/{tglakhir?}',[HomeController::class,'rekapkaryawan']); 
    route::get('/ekspor-rekap-presensi/{tglawal?}/{tglakhir?}', [HomeController::class, 'export']);
});

Route::group(['middleware' => ['auth','ceklevel:karyawan']], function () {
    route::post('/simpan-masuk',[PresensiController::class,'store'])->name('simpan-masuk');
    route::get('/presensi-masuk',[PresensiController::class,'index'])->name('presensi-masuk');    
    route::get('/presensi-keluar',[PresensiController::class,'keluar'])->name('presensi-keluar');
    route::post('/ubah-presensi',[PresensiController::class,'presensipulang'])->name('ubah-presensi');
    route::get('/semua-presensi',[PresensiController::class,'semuapresensi'])->name('semua-presensi');
    route::get('/filter-data-per-rekap/{tglawal?}/{tglakhir?}',[PresensiController::class,'rekapperkaryawan']); 
    route::get('/ekspor-rekap-per-presensi/{tglawal?}/{tglakhir?}', [PresensiController::class, 'export']);
});


