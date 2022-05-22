<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WisataPenginapan_Controller extends Controller
{
    public function penginapan()
    {

        $data['title'] =  "Halaman Penginapan";
        $data['penginapan'] = DB::table('tb_penginapan')->get();
        return view('pengunjung.website.penginapan', $data);
    }
    public function penginapan_post(Request $request)
    {
        $data['title'] =  "Halaman Penginapan";
        $data['penginapan'] = DB::table('tb_penginapan')->where('nama_penginapan', 'LIKE', $request->input('search') . '%')->get();
        if ($request->input('search') == "") {
            $data['penginapan'] = DB::table('tb_penginapan')->get();
        }
        // print_r($data['penginapan']);
        return view('pengunjung.website.penginapan', $data);
    }


    public function detail_penginapan($nama)
    {

        $data['title'] =  "Halaman Penginapan";
        $data['penginapan'] = DB::table('tb_penginapan')->where('nama_penginapan', $nama)->first();
        //    $data['test']
        // echo ($nama);
        return view('pengunjung.website.detailpenginapan', $data);
    }
}
