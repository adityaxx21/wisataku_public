<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WisataKategori_Controller extends Controller
{
    public function kategori($nama)
    {
        $take =1;
        $data['title'] = "Halaman Kategori";
        $id = DB::table('tb_kategori_wisata')->where('nama_wisata', $nama)->value('id_wisata');
        // echo($id);
        $data['margin'] = 'margin-bottom: 32%';
        $data['wisata'] = DB::table('tb_tambah_wisata')->where('id_wisata', $id)->get();
        foreach ($data['wisata'] as $key => $value) {
            if (isset($value)) {
                $rating[$key] = DB::table('tb_pesan_komentar')->where([['id_wisata', $value->id], ['no_pesan', 1]])->average('rating');
                $jumlah[$key] = DB::table('tb_pesan_komentar')->where([['id_wisata', $value->id], ['no_pesan', 1]])->count();
                $take = 0;
                $data['margin'] = '';
            } 
            // echo($take);
        }
        // echo($take);
        if ($take != 1) {
            $data['nama'] = $nama;
            $data['rating'] = $rating;
            $data['jumlah'] = $jumlah;
        } else{
            $data['nama'] = $nama;
        }
        return view('pengunjung.website.kategoriberanda', $data);
    }
}
