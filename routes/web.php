<?php

use App\Http\Controllers\KelolaAkun_Controller;
use App\Http\Controllers\Registrasi_Controller;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\DashboardPengunjung_Controller;
use App\Http\Controllers\DashboardWisata_Controller;
use App\Http\Controllers\KelolaHalamanPengunjung_Controller;
use App\Http\Controllers\KelolaWisata_Controller;
use App\Http\Controllers\KelolaKategori_Controller;
use App\Http\Controllers\KelolaFasilitas_Controller;
use App\Http\Controllers\KelolaPenginapan_Controller;
use App\Http\Controllers\Kelola360_Controller;
use App\Http\Controllers\KelolaSlider_Controller;
use App\Http\Controllers\LaporanTransaksi_Controller;
use App\Http\Controllers\KeolaPesanKomentar_Controller;
use App\Http\Controllers\KelolaPesanKontak_Controller;
use App\Http\Controllers\KelolaQr_Controller;
use App\Http\Controllers\PengunjungEditAkun_Controller;
use App\Http\Controllers\PengunjungKomentar_Controller;
use App\Http\Controllers\PengunjungPesan_Controller;
use App\Http\Controllers\WisataHubungiKami_Controller;
use App\Http\Controllers\WisataKategori_Controller;
use App\Http\Controllers\WisataPenginapan_Controller;
use App\Http\Controllers\WisataTransaksi_Controller;
use App\Http\Kernel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
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



//Bagian Auth
Route::get('/login', [Registrasi_Controller::class, 'login']);
Route::post('/login', [Registrasi_Controller::class, 'login_process']);
Route::get('/signup', [Registrasi_Controller::class, 'signup']);
Route::post('/signup', [Registrasi_Controller::class, 'create']);
Route::get('/logout', [Registrasi_Controller::class, 'logout']);


//Bagian Dasboard
Route::get('/DasboardAdmin', [Dashboard_Controller::class, 'index']); // halaman wisata

// kelola akun
Route::get('/kelolaAkun', [KelolaAkun_Controller::class, 'keola_akun']);
Route::get('/tambahAkun', [KelolaAkun_Controller::class, 'tambah_akun']);
Route::post('/tambahAkun', [KelolaAkun_Controller::class, 'create_data']);

Route::delete('/kelolaAkun/delete/{id}', [KelolaAkun_Controller::class, 'delete']);
Route::get('/editAkun/{id}', [KelolaAkun_Controller::class, 'update']);
Route::get('/editAkun', [KelolaAkun_Controller::class, 'keola']);
Route::post('/editAkun', [KelolaAkun_Controller::class, 'edit_akun']);
// end kelola akun


// Kelola Wisata
Route::get('/kelolaWisata', [KelolaWisata_Controller::class, 'kelola_wisata']);
Route::get('/tambahWisata', [KelolaWisata_Controller::class, 'tambah_wisata']);
Route::post('/tambahWisata', [KelolaWisata_Controller::class, 'create_wisata']);
Route::delete('/kelolaWisata/delete/{id}', [KelolaWisata_Controller::class, 'delete']);
Route::get('/editWisata/{id}', [KelolaWisata_Controller::class, 'update']);
Route::get('/editWisata', [KelolaWisata_Controller::class, 'keola']);
Route::post('/editWisata', [KelolaWisata_Controller::class, 'edit_wisata']);
Route::post('/setupFasilitas', [KelolaWisata_Controller::class, 'setup_fasilitas']);
Route::post('/update_fas/{id}', [KelolaWisata_Controller::class, 'update_fas']);
// end kelola wisata


//kelola Kategori
Route::get('/kelolaKategori', [KelolaKategori_Controller::class, 'kelola_kategori']);
Route::get('/tambahKategori', [KelolaKategori_Controller::class, 'tambah_kategori']);
Route::post('/tambahKategori', [KelolaKategori_Controller::class, 'create_kategori']);

Route::delete('/kelolaKategori/delete/{id}', [KelolaKategori_Controller::class, 'delete']);
Route::get('/editKategori/{id}', [KelolaKategori_Controller::class, 'update']);
Route::get('/editKategori', [KelolaKategori_Controller::class, 'keola']);
Route::post('/editKategori', [KelolaKategori_Controller::class, 'edit_kategori']);
// end kelola kategori

//kelola Fasilitas
Route::get('/kelolaFasilitas', [KelolaFasilitas_Controller::class, 'kelola_fasilitas']);
Route::get('/tambahFasilitas', [KelolaFasilitas_Controller::class, 'tambah_fasilitas']);
Route::post('/tambahFasilitas', [KelolaFasilitas_Controller::class, 'create_fasilitas']);

Route::delete('/kelolaFasilitas/delete/{id}', [KelolaFasilitas_Controller::class, 'delete']);
Route::get('/editFasilitas/{id}', [KelolaFasilitas_Controller::class, 'update']);
Route::get('/editFasilitas', [KelolaFasilitas_Controller::class, 'keola']);
Route::post('/editFasilitas', [KelolaFasilitas_Controller::class, 'edit_fasilitas']);
//end kelola Fasilitas


// kelola penginapan

Route::get('/kelolaPenginapan', [KelolaPenginapan_Controller::class, 'kelola_penginapan']);
Route::get('/tambahPenginapan', [KelolaPenginapan_Controller::class, 'tambah_penginapan']);
Route::post('/tambahPenginapan', [KelolaPenginapan_Controller::class, 'create_penginapan']);
Route::delete('/kelolaPenginapan/delete/{id}', [KelolaPenginapan_Controller::class, 'delete']);

Route::get('/editPenginapan/{id}', [KelolaPenginapan_Controller::class, 'update']);
Route::get('/editPenginapan', [KelolaPenginapan_Controller::class, 'keola']);
Route::post('/editPenginapan', [KelolaPenginapan_Controller::class, 'edit_penginapan']);
//end kelola penginapan


//kelola360
Route::get('/kelola360', [Kelola360_Controller::class, 'kelola_360']);
Route::get('/tambah360', [Kelola360_Controller::class, 'tambah_360']);
Route::post('/tambah360', [Kelola360_Controller::class, 'create_360']);

Route::delete('/kelola360/delete/{id}', [Kelola360_Controller::class, 'delete']);
Route::get('/edit360/{id}', [Kelola360_Controller::class, 'update']);
Route::get('/edit360', [Kelola360_Controller::class, 'keola']);
Route::post('/edit360', [Kelola360_Controller::class, 'edit_360']);
//kelola 360

//kelola komentar
Route::get('/pesanKomentar', [KeolaPesanKomentar_Controller::class, 'kelola_pesan_komentar']);
Route::get('/balasKomentar/{id}', [KeolaPesanKomentar_Controller::class, 'update']);
Route::get('/balasKomentar', [KeolaPesanKomentar_Controller::class, 'keola']);
Route::post('/balasKomentar', [KeolaPesanKomentar_Controller::class, 'balas_komentar']);
Route::post('/hapuskomentar', [KeolaPesanKomentar_Controller::class, 'hapuskomentar']);

//end kelola komentar


// pesan Kontak
Route::get('/pesanKontak', [KelolaPesanKontak_Controller::class, 'kelola_pesan_kontak']);
Route::get('/balasPesan/{id}', [KelolaPesanKontak_Controller::class, 'update']);
Route::get('/balasPesan', [KelolaPesanKontak_Controller::class, 'keola']);
Route::post('/balasPesan', [KelolaPesanKontak_Controller::class, 'balas_kontak']);


// end pesan kontak


//Laporan Transaksi

Route::get('/laporanTransaksi', [LaporanTransaksi_Controller::class, 'laporan_transaksi']);


// end laporan transaksi
Route::get('/halamanPengunjung', [KelolaHalamanPengunjung_Controller::class, 'index']);
Route::post('/halamanPengunjung', [KelolaHalamanPengunjung_Controller::class, 'index_post']);

// View::composer('layout.index', ProfileComposer_Controller::class);

//Slider
Route::get('/kelolaSlider', [KelolaSlider_Controller::class, 'kelola_slider']);
Route::get('/tambahSlider', [KelolaSlider_Controller::class, 'tambah_slider']);
Route::post('/tambahSlider', [KelolaSlider_Controller::class, 'create_slider']);

Route::delete('/kelolaSlider/delete/{id}', [KelolaSlider_Controller::class, 'delete']);

// Operator Side
Route::get('/QrTransaksi', [KelolaQr_Controller::class, 'kelola_QR']);
Route::get('/QrTransaksi/{id}', [KelolaQr_Controller::class, 'detail_data']);
Route::POST('/QrTransaksi', [KelolaQr_Controller::class, 'post_QR']);






// Wisatawan Side

//Halaman Wisata Start
Route::get('/', [DashboardWisata_Controller::class,'index']);
Route::get('/website', [DashboardWisata_Controller::class,'website']);
Route::post('/search', [DashboardWisata_Controller::class,'search_me_post']);
Route::get('/search/{name}', [DashboardWisata_Controller::class,'search_me']);
Route::get('/search', function () {
    return view('pengunjung/website/search', [
        "title" => "Halaman Pengunjung"
    ]);
});

//Transaksi Wisata 
Route::get('/wisata', [WisataTransaksi_Controller::class,'wisata']);
Route::get('/wisata/search/{harga}{nama}', [WisataTransaksi_Controller::class,'wisata']);
Route::get('/detail/{id}', [WisataTransaksi_Controller::class,'detail']);
Route::get('/carirute/{id}', [WisataTransaksi_Controller::class,'carirute']);
Route::get('/pesantiket/{id}', [WisataTransaksi_Controller::class,'pesantiket']);
Route::post('/pesantiket/{id}', [WisataTransaksi_Controller::class,'pesantiket_post']);
Route::get('/detailpesanan/{id}', [WisataTransaksi_Controller::class,'detailpesanan']);
Route::post('/detailpesanan/{id}', [WisataTransaksi_Controller::class,'detailpesanan_post']);
Route::get('/detailtiket/{id}', [WisataTransaksi_Controller::class,'detailtiket']);
Route::get('/invoice/{id}', [WisataTransaksi_Controller::class,'invoice']);

// Route::get('/detailtiket/{id}', [WisataTransaksi_Controller::class,'detailtiket_post']);

//Penginapan Wisata
Route::get('/penginapan', [WisataPenginapan_Controller::class,'penginapan']);
Route::post('/penginapan', [WisataPenginapan_Controller::class,'penginapan_post']);
Route::get('/penginapan/search/{filter}', [WisataPenginapan_Controller::class,'penginapan_filter']);
Route::get('/detailpenginapan/{nama}', [WisataPenginapan_Controller::class,'detail_penginapan']);

//Kategori Wisata
Route::get('/kategori/{nama}', [WisataKategori_Controller::class,'kategori']);


Route::get('/map', [DashboardWisata_Controller::class,'map']);


Route::get('/hubungikami', [WisataHubungiKami_Controller::class,'hubungikami']);
Route::post('/hubungikami', [WisataHubungiKami_Controller::class,'hubungikami_post']);

// Route::get('/carirute', [DashboardWisata_Controller::class,'detail']);






// Route::get('/invoice', function () {
//     return view('pengunjung/website/invoice', [
//         "title" => "Pesan Tiket",
//     ]);

//     // $pdf = Pdf::loadView('pengunjung/website/invoice')->setOptions(['defaultFont' => 'sans-serif']);
//     // return $pdf->download('invoice.pdf');
// });





//Halaman Wisata End



//Halaman Dashboard Start

//Halaman Transaksi
Route::get('/pengunjungDashboard/transaksi', [DashboardPengunjung_Controller::class,'kelola_dashboard_pengunjung']);
Route::get('/pengunjungDashboard/detail/{id}', [DashboardPengunjung_Controller::class,'update']);
Route::get('/pengunjungDashboard/detail', [DashboardPengunjung_Controller::class,'detail']);
Route::post('/pengunjungDashboard/detail', [DashboardPengunjung_Controller::class,'detail_post']);
Route::get('/pengunjungDashboard/ulas/{id}', [DashboardPengunjung_Controller::class,'update_i']);
Route::get('/pengunjungDashboard/ulas', [DashboardPengunjung_Controller::class,'ulas']);
Route::post('/pengunjungDashboard/ulas', [DashboardPengunjung_Controller::class,'ulas_post']);
Route::get('/pengunjungDashboard/hapus/{id}', [DashboardPengunjung_Controller::class,'delete']);

//Halaman Komentar
Route::get('/pengunjungDashboard/komentar', [PengunjungKomentar_Controller::class,'riwayat_komentar']);
Route::get('/hapusPesanKomentar/{id}', [PengunjungKomentar_Controller::class,'hapus_pesan_komentar']);


//Halaman Pesan Kontak
Route::get('/pengunjungDashboard/pesan', [PengunjungPesan_Controller::class,'riwayat_kontak']);
Route::get('/balasKontak/{id}', [PengunjungPesan_Controller::class,'keola']);
Route::post('/balasKontak/{id}', [PengunjungPesan_Controller::class,'balasKontak_post']);
Route::get('/hapusPesanKontak/{id}', [PengunjungPesan_Controller::class,'hapus_pesan_kontak']);

//Halaman Profil
Route::get('/pengunjungDashboard/profile', [PengunjungEditAkun_Controller::class,'edit_profile']);
Route::post('/pengunjungDashboard/profile', [PengunjungEditAkun_Controller::class,'edit_akun']);



//Halaman Dashboard End