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
    return view('page/dashboard');
});

Route::get('/kelolaAkun', function () {
    return view('page/kelolaAkun');
});

Route::get('/kelolaWisata', function () {
    return view('page/kelolaWisata');
});

Route::get('/kelolaKategori', function () {
    return view('page/kelolaKategori');
});

Route::get('/kelolaFasilitas', function () {
    return view('page/kelolaFasilitas');
});

Route::get('/kelolaPenginapan', function () {
    return view('page/kelolaPenginapan');
});

Route::get('/kelola360', function () {
    return view('page/kelola360');
});

Route::get('/kelolaKomentar', function () {
    return view('page/kelolaKomentar');
});

Route::get('/pesanKontak', function () {
    return view('page/pesanKontak');
});

Route::get('/laporanTransaksi', function () {
    return view('page/laporanTransaksi');
});

Route::get('/halamanPengunjung', function () {
    return view('page/halamanPengunjung');
});

Route::get('/sliders', function () {
    return view('page/sliders');
});
