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
    return view('adminpage/dashboard', [
        "title" => "Dashboard"
    ]);
});

// kelola akun
Route::get('/kelolaAkun', function () {
    return view('adminpage/kelolaAkun/kelolaAkun', [
        "title" => "Kelola Akun"
    ]);
});


Route::get('/tambahAkun', function () {
    return view('adminpage/kelolaAkun/tambahAkun', [
        "title" => "Form Tambah Akun"
    ]);
});

// end kelola akun

Route::get('/kelolaWisata', function () {
    return view('adminpage/kelolaWisata', [
        "title" => "Kelola Wisata"
    ]);
});

Route::get('/kelolaKategori', function () {
    return view('adminpage/kelolaKategori', [
        "title" => "Kelola Kategori"
    ]);
});

Route::get('/kelolaFasilitas', function () {
    return view('adminpage/kelolaFasilitas', [
        "title" => "Kelola Fasilitas"
    ]);
});

Route::get('/kelolaPenginapan', function () {
    return view('adminpage/kelolaPenginapan', [
        "title" => "Kelola Penginapan"
    ]);
});

Route::get('/kelola360', function () {
    return view('adminpage/kelola360', [
        "title" => "Kelola 360"
    ]);
});

Route::get('/pesanKomentar', function () {
    return view('adminpage/pesanKomentar', [
        "title" => "Pesan Komentar"
    ]);
});

Route::get('/pesanKontak', function () {
    return view('adminpage/pesanKontak', [
        "title" => "Pesan Kontak"
    ]);
});

Route::get('/laporanTransaksi', function () {
    return view('adminpage/laporanTransaksi', [
        "title" => "Laporan Transaksi"
    ]);
});

Route::get('/halamanPengunjung', function () {
    return view('adminpage/halamanPengunjung', [
        "title" => "Halaman Pengunjung"
    ]);
});

Route::get('/sliders', function () {
    return view('adminpage/sliders', [
        "title" => "Sliders"
    ]);
});
