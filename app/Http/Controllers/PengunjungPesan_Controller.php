<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengunjungPesan_Controller extends Controller
{
     // {{--Kontak--}}
     public function riwayat_kontak()
     {
         $data['title'] = "Halaman Riwayat Kontak";
 
         $data['pesan'] = DB::table('tb_pesan_kontak')->where([
             ['username', '=', session()->get('username')],
             ['no_pesan', '=', 1],
         ])->get();
 
         return view('pengunjung.pesan.riwayatpesankontak', $data);
     }
 
     public function hapus_pesan_kontak($id)
     {
         DB::table('tb_pesan_kontak')->where('id_pesan_kontak', $id)->delete();
         return redirect('/pengunjungDashboard/pesan');
     }
}
