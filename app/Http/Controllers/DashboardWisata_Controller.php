<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardWisata_Controller extends Controller
{
    public function index()
    {
        
       $data['title'] =  "Halaman Pengunjung";
       $data['slider'] = DB::table('tb_slider')->get();
       $data['wisata'] = DB::table('tb_tambah_wisata')->get();
       foreach ($data['wisata'] as $key => $value) {
        $rating[$key] = DB::table('tb_pesan_komentar')->where([['id_wisata',$value->id],['no_pesan',1]])->average('rating');
        $jumlah[$key] = DB::table('tb_pesan_komentar')->where([['id_wisata',$value->id],['no_pesan',1]])->count();
       }
       $data['jumlah'] = $jumlah;
       $data['rating'] = $rating;
       $data['kategori'] = DB::table('tb_kategori_wisata')->get();
    //    print_r($data['rating']);
       return view('pengunjung.website.berandawebsite',$data);
    }
    public function wisata()
    {

       $data['title'] =  "Halaman Wisata";
       
       return view('pengunjung.website.berandawebsite',$data);
    }

    public function map()
    {

       $data['title'] =  "Halaman Maps";
       
       return view('pengunjung.website.menumap',$data);
    }
    public function hubungikami()
    {

       $data['title'] =  "Halaman Hubungi Kami";
       
       return view('pengunjung.website.hubungikami',$data);
    }
   //  public function detail()
   //  {

   //     $data['title'] =  "Halaman Detail Wisata";
       
   //     return view('pengunjung.website.detail',$data);
   //  }
}
