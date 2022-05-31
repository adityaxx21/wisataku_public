<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keola_Wisata;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KelolaWisata_Controller extends Controller
{
    var $location = 'wisata';
    var $glob_id;
    public function kelola_wisata()
    {
        $data['title'] = "Kelola Wisata";
        $data['fasilitas'] = DB::table('tb_fasilitas_wisata')->get();
        $data['pilih_fasilitas'] = DB::table('tb_setel_fasisilitas')->get();

        $data['data_wisata'] = DB::table('tb_tambah_wisata')
            ->selectRaw('tb_tambah_wisata.*,tb_kategori_wisata.nama_wisata as kategori_wisata')
            ->leftJoin('tb_kategori_wisata', 'tb_kategori_wisata.id_wisata', '=', 'tb_tambah_wisata.id_wisata')
            // ->groupBy('tb_tambah_wisata.id')
            ->get();
        


        // print_r($data['data_wisata']);
        return view("adminpage.kelolaWisata.kelolaWisata", $data);
        // print_r($data['pilih_fasilitas']);
    }
    public function update_fas(Request $request,$id)
    {
        $fasilitas = $request->input('fasilitas');
        
        $sav_date    =date("Y-m-d H:i:s");
        // $get_id_fasilitas = DB::table('tb_tambah_wisata')->where('id',session()->get('glob_id'))->value('id_fasilitas_tersedia');
        DB::table('tb_setel_fasisilitas')->where('id_fasilitas_tersedia',$id)->delete();

        foreach ($fasilitas as $key => $value) {
            $get_data1 = array(
                'id_fasilitas_tersedia' =>  $id,
                'id_fasilitas' => $value,
                'updated_at' => $sav_date,
            );
            DB::table('tb_setel_fasisilitas')->insert($get_data1);
            $get_data1 = [];
        }
        return redirect('/kelolaWisata');
    }
    public function tambah_wisata()
    {
        $data['title'] = "Form Tambah Wisata";
        $data['fasilitas'] = DB::table('tb_fasilitas_wisata')->get();
        $data['wisata'] = DB::table('tb_kategori_wisata')->get();
        return view("adminpage.kelolaWisata.tambahWisata", $data);
    }
    public function setup_fasilitas(Request $request)
    {
        $where = array('id' => $request->id);
        $company  = DB::table('tb_setel_fasisilitas')->where('id_fasilitas_tersedia',$where)->value('id_fasilitas');

        return Response()->json($company);
    }

    public function create_wisata(Request $request)
    {

        $nama_wisata = $request->post('namaWisata');
        $sav_date            =date("Y-m-d H:i:s");
        $max_num =  DB::table('tb_tambah_wisata')->max('id_fasilitas_tersedia');
        $get_data = array(
            'id_wisata' => $request->post('kategoriWisata'),
            'nama_wisata' =>  $nama_wisata,
            'jamOperasi' => $request->post('jamOperasi'),
            'jamTutupOperasi' => $request->post('jamTutupOperasi'),
            'deskripsi' => $request->post('deskrisi'),
            'tiketDewasa' => $request->post('tiketDewasa'),
            'tiketAnak' => $request->post('tiketAnak'),
            'alamat' => $request->post('alamat'),
            'parkirmotor' => $request->post('parkirmotor'),
            'parkirmobil' => $request->post('parkirmobil'),
            'parkirumum' => $request->post('parkirumum'),
            'lat' => $request->post('lat'),
            'long' => $request->post('long'),
            'id_fasilitas_tersedia' =>  $max_num + 1,
            'created_at' => $sav_date,
        );
        
        try {
            $fasilitas = $request->input('fasilitas');
            foreach ($fasilitas as $key => $value) {
                $get_data1 = array(
                    'id_fasilitas_tersedia' =>  $max_num + 1,
                    'id_fasilitas' => $value,
                    'created_at' => $sav_date,
                );
                
                DB::table('tb_setel_fasisilitas')->insert($get_data1);
                $get_data1 = [];
            }
        } catch (\Throwable $th) {
            //throw $th;
        }


        // isi dengan nama folder tempat kemana file diupload
        try {
            $name_img =  $request->file('gambar')->getClientOriginalName();
        } catch (\Throwable $th) {
            $name_img = "";
        }
        $img_loc = "storage/" . 'uploads/' . $this->location . "/";
        $img_save = "public/" . 'uploads/' . $this->location . "/";

        $request->file('gambar')->storeAs($img_save, $name_img);

        if (!empty($name_img)) {
            $get_data = array_merge($get_data, array('gambar' =>  $img_loc . $name_img));
        }

        DB::table('tb_tambah_wisata')->insert($get_data);


        return redirect('/kelolaWisata');
    }

    public function update($id)
    {
        session(['glob_id' => $id]);
        // echo (session()->get('glob_id'));
        return redirect('/editWisata');
    }

    public function keola()
    {
        $id = session()->get('glob_id');
        $data['title'] = "Edit Wisata";
        $data['wisata'] = DB::table('tb_tambah_wisata')->where('id',  $id)->first();
        $data['fasilitas'] = DB::table('tb_fasilitas_wisata')->get();
        $data['kategori_wisata'] = DB::table('tb_kategori_wisata')->get();
        $data['setel_fasilitas'] = DB::table('tb_setel_fasisilitas')->select('id_fasilitas')->where('id_fasilitas_tersedia',$data['wisata']->id_fasilitas_tersedia)->get();
        return view("adminpage.kelolaWisata.editWisata", $data);
    }
  

    public function edit_wisata(Request $request)
    {
        $id = session()->get('glob_id');
        $nama_wisata = $request->post('namaWisata');
        $sav_date    =date("Y-m-d H:i:s");
        $get_id_fasilitas = DB::table('tb_tambah_wisata')->where('id',session()->get('glob_id'))->value('id_fasilitas_tersedia');

        // $get_num = DB::table('tb_tambah_wisata')->where('id',);
        $get_data = array(
            'id_wisata' => $request->post('kategoriWisata'),
            'nama_wisata' =>  $nama_wisata,
            'jamOperasi' => $request->post('jamOperasi'),
            'jamTutupOperasi' => $request->post('jamTutupOperasi'),
            'deskripsi' => $request->post('deskrisi'),
            'tiketDewasa' => $request->post('tiketDewasa'),
            'tiketAnak' => $request->post('tiketAnak'),
            'alamat' => $request->post('alamat'),
            'parkirmotor' => $request->post('parkirmotor'),
            'parkirmobil' => $request->post('parkirmobil'),
            'parkirumum' => $request->post('parkirumum'),
            'lat' => $request->post('lat'),
            'long' => $request->post('long'),
            'id_fasilitas_tersedia' =>   $get_id_fasilitas,
            'updated_at' => $sav_date,
        );
        $fasilitas = $request->input('fasilitas');
        DB::table('tb_setel_fasisilitas')->where('id_fasilitas_tersedia',$get_id_fasilitas)->delete();

        foreach ($fasilitas as $key => $value) {
            $get_data1 = array(
                'id_fasilitas_tersedia' =>  $get_id_fasilitas,
                'id_fasilitas' => $value,
                'updated_at' => $sav_date,
            );
            DB::table('tb_setel_fasisilitas')->insert($get_data1);
            $get_data1 = [];
        }

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

        DB::table('tb_tambah_wisata')->where('id', $id)->update($get_data);


        return redirect('/kelolaWisata');
    }


    public function delete($id)
    {

        $id_fas = DB::table('tb_tambah_wisata')->select('id_fasilitas_tersedia')->where('id', $id)->get();
        foreach ($id_fas as $value)
           $take = $value->id_fasilitas_tersedia;
        DB::table('tb_setel_fasisilitas')->where('id_fasilitas_tersedia', $take)->delete();
        DB::table('tb_tambah_wisata')->where('id', $id)->delete();

        // echo strval($value);

        return redirect('/kelolaWisata');
    }
}
