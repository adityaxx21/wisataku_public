<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeolaPesanKomentar_Controller extends Controller
{

    var $location = 'PesanKomentar';
    var $glob_id;
    public function kelola_pesan_komentar(Request $request)
    {
        // $get_hak = DB::table('user_reg')->where('uname',session()->get('username'))->value('hak_akses');
        // echo ($get_hak);
        $data['date'] = $request->input('date');
        $data['search'] = $request->input('search');
        $date = $data['date'] !== "" ? ['tb_pesan_komentar.created_at', 'LIKE', $data['date'] . '%'] : "";
        $wisata = $data['search'] !== "" ? ['tb_tambah_wisata.nama_wisata', 'LIKE', '%' . $data['search'] . '%'] : "";
        $data['title'] = "Pesan Komentar";
        $data['pesan'] = DB::table('tb_pesan_komentar')
            ->selectRaw('tb_pesan_komentar.*,tb_tambah_wisata.nama_wisata as nama_wisata')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_pesan_komentar.id_wisata')
            ->where([['no_pesan', '1'],$date,$wisata])
            ->get();

        // $data['pesan'] = DB::table('tb_pesan_komentar')->where()->get();
        // print_r($data['data_wisata']);
        return view("adminpage.pesanKomentar.pesanKomentar", $data);
    }

    public function update($id)
    {
        session(['glob_id' => $id]);
        return redirect('/balasKomentar');
    }

    public function keola()
    {
        $id = session()->get('glob_id');
        $data['title'] = "Balas Komentar";
        $data['header_pesan'] = DB::table('tb_pesan_komentar')
            ->selectRaw('tb_pesan_komentar.*,tb_tambah_wisata.nama_wisata as nama_wisata')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id_wisata', '=', 'tb_pesan_komentar.id_wisata')
            ->first();

        // $data['header_pesan'] = DB::table('tb_pesan_komentar')->where('id_pesan_komentar',  $id)->first();
        // $data['wisata'] = DB::table('tb_tambah_wisata')->where('id_pesan_komentar',  $id)->first();
        $data['pesan'] = DB::table('tb_pesan_komentar')->where('id_pesan_komentar',  $id)->select('pesan', 'hak_akses', 'username','pesan_balas')->get();
        // print_r( $data['penginapan']);
        // print_r($data['pesan'] );
        return view("adminpage.pesanKomentar.balasKomentar", $data);
    }


    public function balas_komentar(Request $request)
    {
        $id = session()->get('glob_id');
        // $max_num =  DB::table('tb_kategori_wisata')->max('id_wisata');
        $sav_date            = date("Y-m-d H:i:s");
        $data_insert = array(
            'pesan_balas' => $request->post('balasanKomentar'),
            'updated_at' => $sav_date,
        );
        DB::table('tb_pesan_komentar')->where('id_pesan_komentar',$id)->update($data_insert);
        return redirect('/balasKomentar');
    }
}
