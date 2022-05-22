<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalamanUtama_Pengunjung extends Controller
{
    public function kelola_halaman_utama()
    {

       $data['title'] =  "Halaman Pengunjung";
       
       return view('pengunjung.website.berandawebsite',$data);
    }
}
