<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LaporanTransaksi_Controller extends Controller
{
    public function laporan_transaksi(Request $request)
    {
        $data['title'] = "Laporan Transaksi";
        $data['date'] = $request->input('date');
        $data['search'] = $request->input('search');
        $date = $data['date'] !== "" ? ['tanggal_kedatangan', 'LIKE', $data['date'] . '%'] : "";
        $wisata = $data['search'] !== "" ? ['nama_wisata', 'LIKE', '%' . $data['search'] . '%'] : "";

        $data['transaksi'] = DB::table('tb_transaksi')
            ->selectRaw('tb_transaksi.*,user_reg.*,tb_tambah_wisata.*')
            ->leftJoin('user_reg', 'user_reg.uname', '=', 'tb_transaksi.uname')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_transaksi.id_wisata')
            ->orderBy('tb_transaksi.tanggal_kedatangan', 'ASC')
            ->where([$date, $wisata])
            ->get();
        $data['day'] = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', "Fri", 'Sat'];

        $data['jenisLaporan'] = $request->input('jenisLaporan') !== null ? $request->input('jenisLaporan') : 'bulan';
       
        if ($data['jenisLaporan'] == 'bulan') {
            $data['total_transaksi'] = array_fill(0, 12, 0);
            foreach ($data['transaksi'] as $key => $value) {
                $date =  ltrim(date('m', strtotime($value->tanggal_kedatangan)), '0');
                $data['total_transaksi'][(int)$date] +=  1;
            }
        } elseif ($data['jenisLaporan'] == 'minggu') {
            $data['total_transaksi'] = array_fill(0, 7, 0);
            foreach ($data['transaksi'] as $key => $value) {
                $date =  date('D', strtotime($value->tanggal_kedatangan));
                $data['total_transaksi'][array_search($date, $data['day'], true)] +=  1;
            }
        } elseif ($data['jenisLaporan'] == 'tahun') {
            $num = -1;
            $date1 = 0;
            $data['year'] = [];
            foreach ($data['transaksi'] as $key => $value) {
                $date = date('Y', strtotime($value->tanggal_kedatangan));
                if ($date > $date1) {
                    // echo($date." ".$date1."    ");
                    $data['total_transaksi'][] = 0;
                    $data['year'][] = $date;
                    $num += 1;
                    $date1 = $date;
                    $data['total_transaksi'][$num] +=  1;
                } else{             
                    $data['total_transaksi'][$num] +=  1;
                    $date1 = $date;
                } 
               
               
            }
        }
        // print_r($data['year']);
        // print_r($data['total_transaksi']);

        // print_r($data['year']);
        // print_r($data['data_wisata']);
        return view("adminpage.laporanTransaksi.laporanTransaksi", $data);
    }
}
