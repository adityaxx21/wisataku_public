<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaHalamanPengunjung_Controller extends Controller
{
    public function index()
    {
        //ditampilakn di halaman pengunjung
       $data['title'] =  "Halaman Pengunjung";
       $data['halaman'] = DB::table('tb_halaman_pengunjung')->first();
       return view('adminpage.halamanPengunjung',$data);
    }
    public function index_post(Request $request)
    {
        // mengubah pada halaman pengunjung
        $get_data = [
            'judul' => $request->post('judul'),
            'deskripsi'  => $request->post('deskrisi')
        ];
        // print_r($get_data);

        DB::table('tb_halaman_pengunjung')->where('id',10050)->update($get_data);
        return redirect('/halamanPengunjung');
    }
}
