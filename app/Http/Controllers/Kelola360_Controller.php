<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Kelola360_Controller extends Controller
{
    var $location = 'Kelola_360';
    var $glob_id = "";
    public function kelola_360()
    {
        $data['title'] = "Kelola Gambar 360";
        $data['gambar360'] = DB::table('tb_gambar360')->get();


        // print_r($data['data_wisata']);
        return view("adminpage.kelola360.kelola360", $data);
    }
    public function tambah_360()
    {
        $data['title'] = "Form Tambah Gambar 360";

        return view("adminpage.kelola360.tambah360", $data);
    }

    public function create_360(Request $request)
    {
        $max_num =  DB::table('tb_gambar360')->max('id_gambar360');

        $sav_date            =date("Y-m-d H:i:s");

        $get_data = array(
            'id_gambar360' => $max_num+1 ,
            'nama_wisata' =>  $request->post('namaWisata'),
            'url_360' =>  $request->post('link360'),
            'created_at' => $sav_date,
        );
        // isi dengan nama folder tempat kemana file diupload
        try {
            $name_img =  $request->file('gambar')->getClientOriginalName();
        } catch (\Throwable $th) {
            $name_img = "";
        }
        if (!empty($name_img)) {
            $img_loc = "storage/" . 'uploads/' . $this->location . "/";
            $img_save = "public/" . 'uploads/' . $this->location . "/";

            $request->file('gambar')->storeAs($img_save, $name_img);
            $get_data = array_merge($get_data, array('gambar' =>  $img_loc . $name_img));
        }

        
        DB::table('tb_gambar360')->insert($get_data);

        return redirect('/kelola360');

    }
    public function update($id)
    {
        session(['glob_id' => $id]);
        return redirect('/edit360');
    }

    public function keola()
    {
        $id = session()->get('glob_id');
        $data['title'] = "Kelola Gambar 360";
        $data['gambar360'] = DB::table('tb_gambar360')->where('id',  $id)->first();
        // print_r( $data['penginapan']);
        return view("adminpage.kelola360.edit360", $data);
    }


    public function edit_360(Request $request)
    {
        $id = session()->get('glob_id');
        $sav_date            =date("Y-m-d H:i:s");

        $get_data = array(
            'nama_wisata' =>  $request->post('namaWisata'),
            'url_360' =>  $request->post('link360'),
            'updated_at' => $sav_date,
        );
        // isi dengan nama folder tempat kemana file diupload
        try {
            $name_img =  $request->file('gambar')->getClientOriginalName();
        } catch (\Throwable $th) {
            $name_img = "";
        }
        if (!empty($name_img)) {
            $img_loc = "storage/" . 'uploads/' . $this->location . "/";
            $img_save = "public/" . 'uploads/' . $this->location . "/";

            $request->file('gambar')->storeAs($img_save, $name_img);
            $get_data = array_merge($get_data, array('gambar' =>  $img_loc . $name_img));
        }



        $saved =  DB::table('tb_gambar360')->where('id', $id)->update($get_data);

        if ($saved) {
            $request->session()->forget('glob_id');
            echo ('Success');
        }
        return redirect('/kelola360');
    }

    public function delete($id)
    {
        DB::table('tb_gambar360')->where('id', $id)->delete();
        //    echo($id);

        return redirect('/kelola360');
    }

}
