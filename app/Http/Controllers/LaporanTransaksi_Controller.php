<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LaporanTransaksi_Controller extends Controller
{
    public function laporan_transaksi()
    {
        $data['title'] = "Laporan Transaksi";
        // $data['transaksi'] = DB::table('tb_transaksi')->get();
        $data['bulan'] = array('attem' => ['Januari','Februari','Maret']);
        $data['bejibun'] = [100,200,300,400,500,600,700];
        $data['total_transaksi'] = [1100,1200,1300,1400,1500,1600,1700];

        // print_r($data['data_wisata']);
        return view("adminpage.laporanTransaksi.laporanTransaksi", $data);
    }

}
