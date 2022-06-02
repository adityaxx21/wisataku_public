<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Kelola360_Controller extends Controller
{
    // menampilkan halaman kelola360 untuk menghapus ataupun menambah
    var $location = 'Kelola_360';
    
    public function kelola_360()
    {
        $data['title'] = "Kelola Gambar 360";
        $data['gambar360'] = DB::table('tb_gambar360')->get();


        // print_r($data['data_wisata']);
        return view("adminpage.kelola360.kelola360", $data);
    }
    public function tambah_360()
    {
        //fungi membuka halaman tambah
        $data['title'] = "Form Tambah Gambar 360";
        $data['wisata'] = DB::table('tb_tambah_wisata')->get();
        return view("adminpage.kelola360.tambah360", $data);
    }

    public function create_360(Request $request)
    {
        //proses menambahkan gambar pada halaman tambah
        $max_num =  $request->input('id_wisata');
        

        $sav_date            =date("Y-m-d H:i:s");

        $get_data = array(
            'id_gambar360' => $max_num ,
            'nama_wisata' =>  (DB::table('tb_tambah_wisata')->where('id',$max_num)->value('nama_wisata')),
            'url_360' =>  $request->post('link360'),
            'created_at' => $sav_date,
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

        
        DB::table('tb_gambar360')->insert($get_data);

        return redirect('/kelola360');

    }
    public function update($id)
    {
        //mengambil session dari id untuk halaman berikutnya
        session(['glob_id' => $id]);
        return redirect('/edit360');
    }

    public function keola()
    {
        //menampilkan data berdasarkan id dari session yang disimpan sebelummnya
        $id = session()->get('glob_id');
        $data['title'] = "Kelola Gambar 360";
        $data['gambar360'] = DB::table('tb_gambar360')->where('id',  $id)->first();
        $data['wisata'] = DB::table('tb_tambah_wisata')->get();
        // print_r( $data['penginapan']);
        return view("adminpage.kelola360.edit360", $data);
    }


    public function edit_360(Request $request)
    {
        //proses update data dari 360
        $id = session()->get('glob_id');
        $max_num =  $request->input('id_wisata');
        $sav_date            =date("Y-m-d H:i:s");
        $get_data = array(
            'id_gambar360' => $max_num ,
            'nama_wisata' =>  (DB::table('tb_tambah_wisata')->where('id',$max_num)->value('nama_wisata')),
            'url_360' =>  $request->post('link360'),
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

        $saved =  DB::table('tb_gambar360')->where('id', $id)->update($get_data);

        if ($saved) {
            $request->session()->forget('glob_id');
            // echo ('Success');
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
