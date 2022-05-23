<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaHalamanPengunjung_Controller extends Controller
{
    public function index()
    {

       $data['title'] =  "Halaman Pengunjung";
       
       return view('adminpage.halamanPengunjung',$data);
    }
    public function index_post(Request $request)
    {
        $get_data = [
            
        ];
    }
}
