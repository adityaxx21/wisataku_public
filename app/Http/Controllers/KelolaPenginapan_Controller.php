<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaPenginapan_Controller extends Controller
{
    // 
    var $location = 'Penginapan';

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
        // parameter input dari halaman 
        $get_data = array(
            'nama_penginapan' =>  $request->post('namaPenginapan'),
            'deskripsi' => $request->post('deskrisi'),
            'jamOperasi' => $request->post('jamOperasi'),
            'jamTutupOperasi' => $request->post('jamTutupOperasi'),
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
        //menambahkan data dengan input get_data
        DB::table('tb_penginapan')->insert($get_data);

        return redirect('/kelolaPenginapan');
    }

    public function update($id)
    {
        //menyimpan session
        session(['glob_id' => $id]);
        return redirect('/editPenginapan');
    }

    public function keola()
    {
        // mengambil session id
        $id = session()->get('glob_id');
        $data['title'] = "Edit Penginapan";
        $data['penginapan'] = DB::table('tb_penginapan')->where('id',  $id)->first();
        // menampilkan untuk fungsi update data
        return view("adminpage.kelolaPenginapan.editPenginapan", $data);
    }


    public function edit_penginapan(Request $request)
    {
        // fungsi post dengan input id yang didapat dari session
        $id = session()->get('glob_id');
        $sav_date            =date("Y-m-d H:i:s");
        
        $get_data = array(
            'nama_penginapan' =>  $request->post('namaPenginapan'),
            'deskripsi' => $request->post('deskrisi'),
            'jamOperasi' => $request->post('jamOperasi'),
            'jamTutupOperasi' => $request->post('jamTutupOperasi'),
            'alamat' => $request->post('alamat'),
            'harga' => $request->post('hargaPenginapan'),
            'lat' => $request->post('lat'),
            'long' => $request->post('long'),
            'updated_at' => $sav_date,
        );
        // isi dengan nama folder tempat kemana file diupload
//dilakukan kondisi apakah gambar dinputkan atau belum jika sudah tidak akan dilakukan jika belum maka gambar dianggap kosong dan tidak dilakukan pemrosesan apapun
//proses dilakukan dengan mengambil nama gambar dan disimpan dalam database sedangkan file disimpan pada folder storage      
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
        //setelah data disimpan akan dibuat kondisi apakah penyimpanan berhasil atau tiadak
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
