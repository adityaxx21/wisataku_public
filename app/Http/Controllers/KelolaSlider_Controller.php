<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KelolaSlider_Controller extends Controller
{
    var $location = 'Slider';
    public function kelola_slider()
    {
        $data['title'] = "Kelola Slider";
        $data['slider'] = DB::table('tb_slider')->get();

        // print_r($data['data_wisata']);
        return view("adminpage.kelolaSlider.kelolaSlider", $data);
    }
    public function tambah_slider()
    {
        $data['title'] = "Form Tambah Slider";

        return view("adminpage.kelolaSlider.tambahSlider", $data);
    }

    public function create_slider(Request $request)
    {
        $sav_date            =date("Y-m-d H:i:s");

        $get_data = array(
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

        DB::table('tb_slider')->insert($get_data);

        return redirect('/kelolaSlider');
    }

    public function delete($id)
    {
        DB::table('tb_slider')->where('id', $id)->delete();
        // $id_fasilitas = DB::table('tb_slider')->where('id', $id)->value('id_fasilitas');
        // DB::table('tb_setel_fasisilitas')->where('id_fasilitas', $id_fasilitas)->delete();
        //    echo($id);
        return redirect('/kelolaSlider');
    }
}
