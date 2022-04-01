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

Route::get('/login', function () {
    return view('auth/login');
});
Route::get('/singup', function () {
    return view('auth/registration');
});

Route::get('/', function () {
    return view('adminpage/dashboard');
});

Route::get('/kelolaAkun', function () {
    return view('adminpage/kelolaAkun');
});

Route::get('/kelolaWisata', function () {
    return view('adminpage/kelolaWisata');
});

Route::get('/kelolaKategori', function () {
    return view('adminpage/kelolaKategori');
});

Route::get('/kelolaFasilitas', function () {
    return view('adminpage/kelolaFasilitas');
});

Route::get('/kelolaPenginapan', function () {
    return view('adminpage/kelolaPenginapan');
});

Route::get('/kelola360', function () {
    return view('adminpage/kelola360');
});

Route::get('/kelolaKomentar', function () {
    return view('adminpage/kelolaKomentar');
});

Route::get('/pesanKontak', function () {
    return view('adminpage/pesanKontak');
});

Route::get('/laporanTransaksi', function () {
    return view('adminpage/laporanTransaksi');
});

Route::get('/halamanPengunjung', function () {
    return view('adminpage/halamanPengunjung');
});

Route::get('/sliders', function () {
    return view('adminpage/sliders');
});
