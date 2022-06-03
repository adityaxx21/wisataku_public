<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Strings;
use Illuminate\Support\Facades\Session;
use Dompdf\Dompdf;

class LaporanTransaksi_Controller extends Controller
{

    // private $dataDownload = 11;

    public function laporan_transaksi(Request $request)
    {
        // menampilkan isi dari laporan transaksi 
        $data['title'] = "Laporan Transaksi";
        $data['date'] = $request->input('date');
        $data['search'] = $request->input('search');
        // pencarian data jika diinputkan
        $date = $data['date'] !== "" ? ['tanggal_kedatangan', 'LIKE', $data['date'] . '%'] : "";
        $wisata = $data['search'] !== "" ? ['nama_wisata', 'LIKE', '%' . $data['search'] . '%'] : "";
        $data['jenisLaporan'] = $request->input('jenisLaporan') !== null ? $request->input('jenisLaporan') : 'Bulanan';
        $last_week = date('Y-m-d', strtotime(date('Y-m-d'). ' - 7 days')); 
        if ($data['jenisLaporan'] == 'Bulanan' && $data['date'] == null) {
            $data['transaksi'] = DB::table('tb_transaksi')
            ->selectRaw('tb_transaksi.*,user_reg.*,tb_tambah_wisata.*')
            ->leftJoin('user_reg', 'user_reg.uname', '=', 'tb_transaksi.uname')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_transaksi.id_wisata')
            ->orderBy('tb_transaksi.tanggal_kedatangan', 'ASC')
            ->where([$date, $wisata,['id_status_pemb',0]])
            ->whereYear('tb_transaksi.tanggal_kedatangan','=',2022)
            ->groupByRaw('tb_transaksi.id')
            ->get();
        } else if ($data['jenisLaporan'] == 'Mingguan' && $data['date'] == null) {
            $data['transaksi'] = DB::table('tb_transaksi')
            ->selectRaw('tb_transaksi.*,user_reg.*,tb_tambah_wisata.*')
            ->leftJoin('user_reg', 'user_reg.uname', '=', 'tb_transaksi.uname')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_transaksi.id_wisata')
            ->orderBy('tb_transaksi.tanggal_kedatangan', 'ASC')
            ->where([$date, $wisata,['id_status_pemb',0]])
            ->whereDate('tb_transaksi.created_at','>=' , $last_week)
            ->groupByRaw('tb_transaksi.id')
            ->get();
        } else {
            $data['transaksi'] = DB::table('tb_transaksi')
            ->selectRaw('tb_transaksi.*,user_reg.*,tb_tambah_wisata.*')
            ->leftJoin('user_reg', 'user_reg.uname', '=', 'tb_transaksi.uname')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_transaksi.id_wisata')
            ->orderBy('tb_transaksi.tanggal_kedatangan', 'ASC')
            ->where([$date, $wisata,['id_status_pemb',0]])
            ->groupByRaw('tb_transaksi.id')
            ->get();
        }
        


        $data['day'] = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', "Fri", 'Sat'];
        // menentukan jenis laporan jika tidak diubah default bulanan

        //akan melakukan filter bulanan sesuai data yang ada di database yang mana nama" bulan terdapat di script.js bagian laporan transaksi
        if ($data['jenisLaporan'] == 'Bulanan') {
            $data['total_transaksi'] = array_fill(0, 12, 0);
            foreach ($data['transaksi'] as $key => $value) {
                $date =  ltrim(date('m', strtotime($value->tanggal_kedatangan)), '0');
                $data['total_transaksi'][(int)$date] +=  1;
            }
            //akan melakukan filter mingguan sesuai data yang ada di database 
        } elseif ($data['jenisLaporan'] == 'Mingguan') {
            $data['total_transaksi'] = array_fill(0, 7, 0);
            foreach ($data['transaksi'] as $key => $value) {
                $date =  date('D', strtotime($value->tanggal_kedatangan));
                $data['total_transaksi'][array_search($date, $data['day'], true)] +=  1;
            }
            //akan melakukan filter tahubab sesuai data yang ada di database 
        } elseif ($data['jenisLaporan'] == 'Tahunan') {
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
                } else {
                    $data['total_transaksi'][$num] +=  1;
                    $date1 = $date;
                }
            }
        }
        // data disimpan dalam session untuk dilakukan print
        Session::put('datalaporan', $data['transaksi']);
        Session::put('jenislaporan', $data['jenisLaporan']);
        Session::put('canvas', $request->input('cavas_here'));

        return view("adminpage.laporanTransaksi.laporanTransaksi", $data);
    }




    public function downloadLaporan(Request $request)
    {
        // $this->laporan_transaksi($request);
        // mengambil data dari session untuk diprint dalam bentuk dokumen
        $data['transaksi'] = Session::get('datalaporan');
        $data['jenislaporan'] = Session::get('jenislaporan');
        $data['gambar'] = $request->input('cavas_here');
        $data['jumlah_pengunjung'] = 0;
        foreach ($data['transaksi'] as $value) {
            $data['jumlah_pengunjung'] += $value->jumlah_tiket_dewasa + $value->jumlah_tiket_anak;
        }

        // print_r($data['jenislaporan']);
        $view = view("adminpage.laporanTransaksi.downloadLaporan", $data);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Laporan Transaksi");
        return view("adminpage.laporanTransaksi.downloadLaporan", $data);
        // return redirect('/');
    }
}
