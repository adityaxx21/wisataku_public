<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaPesanKontak_Controller extends Controller
{

    var $location = 'PesanKontak';
    var $glob_id;
    public function kelola_pesan_kontak(Request $request)
    {
        $data['title'] = "Pesan Komentar";
        $data['date'] = $request->input('date');
        $data['search'] = $request->input('search');
        $date = $data['date'] !== "" ? ['created_at', 'LIKE', $data['date'] . '%'] : "";
        $username = $data['search'] !== "" ? ['username', 'LIKE', '%' . $data['search'] . '%'] : "";
        $data['pesan'] = DB::table('tb_pesan_kontak')->where([['no_pesan','1'],$date,$username])->get();

        // $data['pesan'] = DB::table('tb_pesan_komentar')->where()->get();
        // print_r($data['pesan']);
        return view("adminpage.pesanKontak.pesanKontak", $data);
    }

    public function update($id)
    {
        session(['glob_id' => $id]);
        return redirect('/balasPesan');
    }

    public function keola()
    {
        $id = session()->get('glob_id');
        $data['title'] = "Balas Komentar";

        $data['header_pesan'] = DB::table('tb_pesan_kontak')->where('id_pesan_kontak',  $id)->first();
        // $data['wisata'] = DB::table('tb_tambah_wisata')->where('id_pesan_komentar',  $id)->first();
        $data['pesan'] = DB::table('tb_pesan_kontak')->where('id_pesan_kontak',  $id)->select('pesan', 'hak_akses', 'username')->get();
        $data['last_no'] = DB::table('tb_pesan_kontak')->where('id_pesan_kontak',  $id)->max('no_pesan');

        // print_r( $data['penginapan']);
        // print_r($data['pesan'] );
        return view("adminpage.pesanKontak.balasPesan", $data);
    }


    public function balas_kontak(Request $request)
    {
        $id = session()->get('glob_id');
        // $max_num =  DB::table('tb_kategori_wisata')->max('id_wisata');
        $get_max = DB::table('tb_pesan_kontak')->where('id_pesan_kontak',  $id)->max('no_pesan');
        $get_data = DB::table('tb_pesan_kontak')->where('id_pesan_kontak',  $id)->first();
        $sav_date            = date("Y-m-d H:i:s");
        $data_insert = array(
            'id_pesan_kontak' => $get_data->id_pesan_kontak,
            'no_pesan' => $get_max+1,
            'hak_akses' => session()->get('hak_akses'),
            'username' => session()->get('username'),
            'email' => "",
            'no_hp' => "",
            'pesan' => $request->post('balasanPesan'),
            'created_at' => $sav_date,
        );
        // print_r ($data_insert);
        DB::table('tb_pesan_kontak')->insert($data_insert);
        return redirect('/balasPesan');
    }
}
