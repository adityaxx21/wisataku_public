<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengunjungPesan_Controller extends Controller
{
     // {{--Kontak--}}
    //  menampilkan riwayat pesan
     public function riwayat_kontak()
     {
         $data['title'] = "Halaman Riwayat Kontak";
 
         $data['pesan'] = DB::table('tb_pesan_kontak')->where([
             ['username', '=', session()->get('username')],
             ['no_pesan', '=', 1],
         ])->get();
 
         return view('pengunjung.pesan.riwayatpesankontak', $data);
     }
     
    public function keola($id)
    {
        // proses untuk balas komentar seperti fitur chat
        $data['title'] = "Balas Komentar";

        $data['header_pesan'] = DB::table('tb_pesan_kontak')->where('id_pesan_kontak',  $id)->first();
        // $data['wisata'] = DB::table('tb_tambah_wisata')->where('id_pesan_komentar',  $id)->first();
        $data['pesan'] = DB::table('tb_pesan_kontak')->where('id_pesan_kontak',  $id)->select('pesan', 'hak_akses', 'username')->get();
        $data['last_no'] = DB::table('tb_pesan_kontak')->where('id_pesan_kontak',  $id)->max('no_pesan');

        // print_r( $data['penginapan']);
        // print_r($data['pesan'] );
        return view("pengunjung.pesan.balasPesan", $data);
    }


    public function balasKontak_post(Request $request,$id)
    {
        // balas pesan berdasarkan no_pesan, nilai 1 merupakan pesan pertama yang dikirim oleh user dan sisanya bergantian tergantung admin atau user
        // $max_num =  DB::table('tb_kategori_wisata')->max('id_wisata');
        $get_max = DB::table('tb_pesan_kontak')->where('id_pesan_kontak',  $id)->max('no_pesan');
        $get_data = DB::table('tb_pesan_kontak')->where('id_pesan_kontak',  $id)->first();
        $sav_date            = date("Y-m-d H:i:s");
        $data_insert = array(
            'id_pesan_kontak' => $get_data->id_pesan_kontak,
            'no_pesan' => $get_max+1,
            'hak_akses' => session()->get('hak_akses'),
            'username' => session()->get('username'),
            'email' => $get_data->email,
            'no_hp' =>  $get_data->no_hp,
            'pesan' => $request->post('balasanPesan'),
            'created_at' => $sav_date,
        );
        print_r ($data_insert);
        DB::table('tb_pesan_kontak')->insert($data_insert);
        return redirect('/balasKontak/'.$id);
    }
 
     public function hapus_pesan_kontak($id)
     {
         DB::table('tb_pesan_kontak')->where('id_pesan_kontak', $id)->delete();
         return redirect('/pengunjungDashboard/pesan');
     }
}
