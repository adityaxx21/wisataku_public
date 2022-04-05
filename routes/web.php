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


// Kelola Wisata
Route::get('/kelolaWisata', function () {
    return view('adminpage/kelolaWisata/kelolaWisata', [
        "title" => "Kelola Wisata"
    ]);
});

Route::get('/tambahWisata', function () {
    return view('adminpage/kelolaWisata/tambahWisata', [
        "title" => "Form Tambah Wisata"
    ]);
});

Route::get('/setupFasilitas', function () {
    return view('adminpage/kelolaWisata/setupFasilitas', [
        "title" => "Setup Fasilitas Wisata"
    ]);
});

// end kelola wisata


//kelola Kategori
Route::get('/kelolaKategori', function () {
    return view('adminpage/kelolaKategori/kelolaKategori', [
        "title" => "Kelola Kategori"
    ]);
});

Route::get('/tambahKategori', function () {
    return view('adminpage/kelolaKategori/tambahKategori', [
        "title" => "Form Tambah Kategori"
    ]);
});
// end kelola kategori

//kelola Fasilitas
Route::get('/kelolaFasilitas', function () {
    return view('adminpage/kelolaFasilitas/kelolaFasilitas', [
        "title" => "Kelola Fasilitas"
    ]);
});

Route::get('/tambahFasilitas', function () {
    return view('adminpage/kelolaFasilitas/tambahFasilitas', [
        "title" => "Form Tambah Fasilitas"
    ]);
});

//end kelola Fasilitas


// kelola penginapan
Route::get('/kelolaPenginapan', function () {
    return view('adminpage/kelolaPenginapan/kelolaPenginapan', [
        "title" => "Kelola Penginapan"
    ]);
});
Route::get('/tambahPenginapan', function () {
    return view('adminpage/kelolaPenginapan/tambahPenginapan', [
        "title" => "Form Tambah Penginapan"
    ]);
});

//end kelola penginapan


//kelola360
Route::get('/kelola360', function () {
    return view('adminpage/kelola360/kelola360', [
        "title" => "Kelola 360"
    ]);
});
Route::get('/tambah360', function () {
    return view('adminpage/kelola360/tambah360', [
        "title" => "Tambah 360"
    ]);
});

//kelola 360

//kelola komentar

Route::get('/pesanKomentar', function () {
    return view('adminpage/pesanKomentar/pesanKomentar', [
        "title" => "Pesan Komentar"
    ]);
});

Route::get('/balasKomentar', function () {
    return view('adminpage/pesanKomentar/balasKomentar', [
        "title" => "Balas Komentar"
    ]);
});

//end kelola komentar

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
