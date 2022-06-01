<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardWisata_Controller extends Controller
{
    public function index()
    {
       //menampilkan data pada halaman webiste
       $data['title'] =  "Halaman Pengunjung";
       $data['slider'] = DB::table('tb_slider')->get();
       $data['wisata'] = DB::table('tb_tambah_wisata')->orderBy('rating','desc')->paginate(5);
       $data['halaman_pengunjung'] = DB::table('tb_halaman_pengunjung')->first();
       $data['kategori'] = DB::table('tb_kategori_wisata')->get();
       return view('pengunjung.website.berandawebsite',$data);
    }
    public function map()
    {
      //menampilkan halaman map dari menu atas
       $data['title'] =  "Halaman Maps";
       $data['wisata'] =  DB::table('tb_tambah_wisata')->get();
       return view('pengunjung.website.menumap',$data);
    }

    public function search_me_post(Request $request)
    {
      //fungsi post pada kolom pencarian
       $data['title'] =  "Hasil Pencarian";
       $find = $request->input('search-box');
 
       
       return redirect('/search/'.$find);
    }
    public function search_me($name)
    {
       //menampilkan hasil pencarian 
      $data['title'] =  "Hasil Pencarian";
      $data['name'] = $name;
      $data['wisata'] = DB::table('tb_tambah_wisata')->where('nama_wisata', 'LIKE', '%'.$name . '%')->get();
      foreach ($data['wisata'] as $key => $value) {
       $rating[$key] = round(DB::table('tb_pesan_komentar')->where([['id_wisata',$value->id],['no_pesan',1]])->average('rating'),2);
       $jumlah[$key] = DB::table('tb_pesan_komentar')->where([['id_wisata',$value->id],['no_pesan',1]])->count();
      }
      try {
         $data['jumlah'] = $jumlah;
         $data['rating'] = $rating;
      } catch (\Throwable $th) {
      }

      $data['penginapan'] = DB::table('tb_penginapan')->where('nama_penginapan', 'LIKE','%'. $name . '%')->get();
      $data['kategori'] = DB::table('tb_kategori_wisata')->where('nama_wisata', 'LIKE', '%'.$name . '%')->get();
      $data['search'] = $name;
      return view('pengunjung.website.search',$data);
    }
}
