<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaPenginapan_Controller extends Controller
{

    var $location = 'Penginapan';
    var $glob_id;
    public function kelola_penginapan()
    {
        $data['title'] = "Kelola Penginapan";
        $data['penginapan'] = DB::table('tb_penginapan')->get();


        // print_r($data['data_wisata']);
        return view("adminpage.kelolaPenginapan.kelolaPenginapan", $data);
    }
    public function tambah_penginapan()
    {
        $data['title'] = "Form Tambah Penginapan";

        return view("adminpage.kelolaPenginapan.tambahPenginapan", $data);
    }

    public function create_penginapan(Request $request)
    {

        $sav_date            =date("Y-m-d H:i:s");

        $get_data = array(
            'nama_penginapan' =>  $request->post('namaPenginapan'),
            'deskripsi' => $request->post('deskrisi'),
            'alamat' => $request->post('alamat'),
            'harga' => $request->post('hargaPenginapan'),
            'lat' => $request->post('lat'),
            'long' => $request->post('long'),
            'created_at' => $sav_date,
        );
        // isi dengan nama folder tempat kemana file diupload
        $name_img =  $request->file('gambar')->getClientOriginalName();
        $img_loc = "storage/" . 'uploads/' . $this->location . "/";
        $img_save = "public/" . 'uploads/' . $this->location . "/";

        $request->file('gambar')->storeAs($img_save, $name_img);

        if (!empty($name_img)) {
            $get_data = array_merge($get_data, array('gambar' =>  $img_loc . $name_img));
        }

        DB::table('tb_penginapan')->insert($get_data);

        return redirect('/kelolaPenginapan');
    }

    public function update($id)
    {
        session(['glob_id' => $id]);
        return redirect('/editPenginapan');
    }

    public function keola()
    {
        $id = session()->get('glob_id');
        $data['title'] = "Edit Penginapan";
        $data['penginapan'] = DB::table('tb_penginapan')->where('id',  $id)->first();
        // print_r( $data['penginapan']);
        return view("adminpage.kelolaPenginapan.editPenginapan", $data);
    }


    public function edit_penginapan(Request $request)
    {
        $id = session()->get('glob_id');
        $sav_date            =date("Y-m-d H:i:s");

        $get_data = array(
            'nama_penginapan' =>  $request->post('namaPenginapan'),
            'deskripsi' => $request->post('deskrisi'),
            'alamat' => $request->post('alamat'),
            'harga' => $request->post('hargaPenginapan'),
            'lat' => $request->post('lat'),
            'long' => $request->post('long'),
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



        $saved =  DB::table('tb_penginapan')->where('id', $id)->update($get_data);

        if ($saved) {
            $request->session()->forget('glob_id');
            echo ('Success');
        }
        return redirect('/kelolaPenginapan');
    }

    public function delete($id)
    {
        DB::table('tb_penginapan')->where('id', $id)->delete();
        //    echo($id);


        return redirect('/kelolaPenginapan');
    }
}
