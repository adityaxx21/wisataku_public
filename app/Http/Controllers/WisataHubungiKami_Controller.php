<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WisataHubungiKami_Controller extends Controller
{
    public function hubungikami()
    {
        // bagian ini dipakai untuk memulai pesan kontak pada admin
       $data['title'] =  "Halaman Hubungi Kami";
       $data['akun'] = DB::table('user_reg')->where('uname',session()->get('username'))->first();
       
       return view('pengunjung.website.hubungikami',$data);
    }
    public function hubungikami_post(Request $request)
    {
        // proses post dari pesan kontak
        $id_pesan_kontak = DB::table('tb_pesan_kontak')->max('id_pesan_kontak');
        $sav_date            = date("Y-m-d H:i:s");
        $get_data = array(
            'id_pesan_kontak' => $id_pesan_kontak+1,
            'no_pesan' => 1,
            'hak_akses' => session()->get('hak_akses'),
            'username' =>session()->get('username'),
            'email' =>$request->input('email'),
            'no_hp' =>$request->input('email'),
            'pesan' =>$request->input('comment'),
            'created_at' => $sav_date,
            );
        DB::table('tb_pesan_kontak')->insert($get_data);
        return redirect('/hubungikami')->with('msg_alert','berhasil menginputkan pesan, lihat balasan di menu dasboard');
    }
}
