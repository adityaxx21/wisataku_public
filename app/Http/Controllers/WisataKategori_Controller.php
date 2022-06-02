<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WisataKategori_Controller extends Controller
{
    public function kategori($nama)
    {
        // proses pada menu kategori untuk menampilkan data dengan atau tanpa filter
        $data['title'] = "Halaman Kategori";
        $id = DB::table('tb_kategori_wisata')->where('nama_wisata', $nama)->value('id_wisata');
        // echo($id);
        $data['margin'] = 'margin-bottom: 32%';
        $data['wisata'] = DB::table('tb_tambah_wisata')->where('id_wisata', $id)->get();
        if ($data['wisata'][0]->nama_wisata != null) {
            $data['margin'] = '';
        }
        // echo($take);
        $data['nama'] = $nama;
        // print_r($data['rating']);
        return view('pengunjung.website.kategoriberanda', $data);
    }
}
