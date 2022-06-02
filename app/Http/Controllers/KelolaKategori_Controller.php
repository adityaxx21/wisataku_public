<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KelolaKategori_Controller extends Controller
{
    var $location = 'Kategori';
    
    public function kelola_kategori()
    {
        //menampilkan list kategori
        $data['title'] = "Kelola Kategori";
        $data['kategori_wisata'] = DB::table('tb_kategori_wisata')->get();


        // print_r($data['data_wisata']);
        return view("adminpage.kelolaKategori.kelolaKategori", $data);
    }
    public function tambah_kategori()
    {
        // menu tambah kategori
        $data['title'] = "Form Tambah Kategori";

        return view("adminpage.kelolaKategori.tambahKategori", $data);
    }

    public function create_kategori(Request $request)
    {
        // fungsi post tambah kategori
        $max_num =  DB::table('tb_kategori_wisata')->max('id_wisata');

        $sav_date            =date("Y-m-d H:i:s");

        $get_data = array(
            'id_wisata' => $max_num+1 ,
            'nama_wisata' =>  $request->post('namaKategori'),
            'created_at' => $sav_date,
        );
        // isi dengan nama folder tempat kemana file diupload

        $name_img =  $request->file('gambar')->getClientOriginalName();
        $img_loc = "storage/".'uploads/'.$this->location."/";
        $img_save = "public/".'uploads/'.$this->location."/";
 
        $request->file('gambar')->storeAs( $img_save,$name_img);

        if (!empty($name_img)) {
            $get_data = array_merge($get_data, array('gambar' =>  $img_loc.$name_img));
        } 
        
        DB::table('tb_kategori_wisata')->insert($get_data);

        return redirect('/kelolaKategori');

    }

    public function update($id)
    {
        // menyimpan session
        session(['glob_id' => $id]);
        return redirect('/editKategori');
    }

    public function keola()
    {
        //menampilkan  edit kategori
        $id = session()->get('glob_id');
        $data['title'] = "Edit Kategori";
        $data['kategori'] = DB::table('tb_kategori_wisata')->where('id',  $id)->first();
        // print_r( $data['penginapan']);
        return view("adminpage.kelolaKategori.editKategori", $data);
    }


    public function edit_kategori(Request $request)
    {
        //update kategori
        $id = session()->get('glob_id');
        // $max_num =  DB::table('tb_kategori_wisata')->max('id_wisata');

        $sav_date            =date("Y-m-d H:i:s");
        $get_data = array(
            'nama_wisata' =>  $request->post('namaKategori'),
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

        $saved =  DB::table('tb_kategori_wisata')->where('id', $id)->update($get_data);

        if ($saved) {
            $request->session()->forget('glob_id');
            echo ('Success');
        }
        return redirect('/kelolaKategori');
    }

    public function delete($id)
    {
        DB::table('tb_kategori_wisata')->where('id', $id)->delete();
        //    echo($id);
        return redirect('/kelolaKategori');
    }

}
