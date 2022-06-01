<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard_Controller extends Controller
{
    public function index(Request $request)
    {

        if (session()->has('username') == false) {
            return redirect("/login");
        }
        //Digunakan untuk memanggil jumlah tiap data dari tiap" table dalam halaman dashboard admin
        $data['title'] = "Dashboard";
        $data['jumlah_wisata'] = DB::table('tb_tambah_wisata')->count();
        $data['jumlah_akun'] = DB::table('user_reg')->count();
        $data['jumlah_kategori'] = DB::table('tb_kategori_wisata')->count();
        $data['jumlah_360'] = DB::table('tb_gambar360')->count();
        $data['jumlah_transaksi'] = DB::table('tb_transaksi')->count();
        return view("adminpage.dashboard", $data);

        // $request->session()->forget('Nama');


    }
}
