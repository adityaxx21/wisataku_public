<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KelolaFasilitas_Controller extends Controller
{
    var $location = 'Fasilitas';
    var $glob_id = '';
    public function kelola_Fasilitas()
    {
        $data['title'] = "Kelola Fasilitas";
        $data['fasilitas_wisata'] = DB::table('tb_fasilitas_wisata')->get();


        // print_r($data['data_wisata']);
        return view("adminpage.kelolaFasilitas.kelolaFasilitas", $data);
    }
    public function tambah_fasilitas()
    {
        $data['title'] = "Form Tambah Fasilitas";

        return view("adminpage.kelolaFasilitas.tambahFasilitas", $data);
    }

    public function create_fasilitas(Request $request)
    {
        $max_num =  DB::table('tb_fasilitas_wisata')->max('id_fasilitas');

        $sav_date            =date("Y-m-d H:i:s");

        $get_data = array(
            'id_fasilitas' => $max_num + 1,
            'nama_fasilitas' =>  $request->post('namaFasilitas'),
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

        DB::table('tb_fasilitas_wisata')->insert($get_data);

        return redirect('/kelolaFasilitas');
    }

    public function update($id)
    {
        session(['glob_id' => $id]);
        return redirect('/editFasilitas');
    }

    public function keola()
    {
        $id = session()->get('glob_id');
        $data['title'] = "Edit Fasilitas";
        $data['fasilitas'] = DB::table('tb_fasilitas_wisata')->where('id',  $id)->first();
        // print_r( $data['penginapan']);
        return view("adminpage.kelolaFasilitas.editFasilitas", $data);
    }

    public function edit_fasilitas(Request $request)
    {
        $id = session()->get('glob_id');
        // $max_num =  DB::table('tb_kategori_wisata')->max('id_wisata');

        $sav_date            =date("Y-m-d H:i:s");
        $get_data = array(
            'nama_fasilitas' =>  $request->post('namaFasilitas'),
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

        $saved =  DB::table('tb_fasilitas_wisata')->where('id', $id)->update($get_data);

        if ($saved) {
            $request->session()->forget('glob_id');
            echo ('Success');
        }
        return redirect('/kelolaFasilitas');
    }

    public function delete($id)
    {
        DB::table('tb_fasilitas_wisata')->where('id', $id)->delete();
        $id_fasilitas = DB::table('tb_fasilitas_wisata')->where('id', $id)->value('id_fasilitas');
        // DB::table('tb_setel_fasisilitas')->where('id_fasilitas', $id_fasilitas)->delete();
        //    echo($id);
        return redirect('/kelolaFasilitas');
    }
}
