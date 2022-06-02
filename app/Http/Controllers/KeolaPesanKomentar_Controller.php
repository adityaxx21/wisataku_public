<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Dompdf\Dompdf;

class KeolaPesanKomentar_Controller extends Controller
{

    var $location = 'PesanKomentar';

    public function kelola_pesan_komentar(Request $request)
    {
        // menampilkan pesan serta mealkukan filter bila diinputkan
        $data['date'] = $request->input('date');
        $data['search'] = $request->input('search');
        // filter tanggal dan pencarian
        $date = $data['date'] !== "" ? ['tb_pesan_komentar.created_at', 'LIKE', $data['date'] . '%'] : "";
        $wisata = $data['search'] !== "" ? ['tb_tambah_wisata.nama_wisata', 'LIKE', '%' . $data['search'] . '%'] : "";
        $data['title'] = "Pesan Komentar";
        $data['pesan'] = DB::table('tb_pesan_komentar')
            ->selectRaw('tb_pesan_komentar.*,tb_tambah_wisata.nama_wisata as nama_wisata')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_pesan_komentar.id_wisata')
            ->where([['no_pesan', '1'], $date, $wisata])
            ->get();

        Session::put('pesanKomentar', $data);
        return view("adminpage.pesanKomentar.pesanKomentar", $data);
    }


    public function downloadKomentar()
    {
        // proses download pdf berdasarkan yang ditampilkan dalam table
        $data = Session::get('pesanKomentar');

        // print_r($data['jenislaporan']);
        $view = view("adminpage.pesanKomentar.downloadKomentar", $data);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Rekap Data Pesan Komentar");
        return view("adminpage.pesanKomentar.downloadKomentar", $data);
    }

    public function update($id)
    {
        // mengambil id komentar
        session(['glob_id' => $id]);
        return redirect('/balasKomentar');
    }

    public function keola()
    {
        // menampilkan pesan serta menu untuk membalas komentar
        $id = session()->get('glob_id');
        $data['title'] = "Balas Komentar";
        $data['header_pesan'] = DB::table('tb_pesan_komentar')
            ->selectRaw('tb_pesan_komentar.*,tb_tambah_wisata.nama_wisata as wisata')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_pesan_komentar.id_wisata')
            ->first();
        $data['pesan'] = DB::table('tb_pesan_komentar')->where('id_pesan_komentar',  $id)->select('pesan', 'hak_akses', 'username', 'pesan_balas')->get();
        return view("adminpage.pesanKomentar.balasKomentar", $data);
    }


    public function balas_komentar(Request $request)
    {
        // melakukan update pada table untuk membalas komentar
        $id = session()->get('glob_id');
        // $max_num =  DB::table('tb_kategori_wisata')->max('id_wisata');
        $sav_date            = date("Y-m-d H:i:s");
        $data_insert = array(
            'pesan_balas' => $request->post('balasanKomentar'),
            'updated_at' => $sav_date,
        );
        DB::table('tb_pesan_komentar')->where('id_pesan_komentar', $id)->update($data_insert);
        return redirect('/balasKomentar');
    }

    public function hapuskomentar(Request $request)
    {
        // hapus komentar
        $sav_date            = date("Y-m-d H:i:s");
        $id_pesan = $request->input('id_pesan');
       $get_data = array(
           'pesan'=>'[pesan telah dihapus oleh admin karena mengandung kata yang tidak pantas]',
           'is_deleted' => 0,
           'updated_at' => $sav_date,
       );
       DB::table('tb_pesan_komentar')->where([['id_pesan_komentar',$id_pesan],['no_pesan',1]])->update($get_data);
       return redirect('/balasKomentar');
    }
}
