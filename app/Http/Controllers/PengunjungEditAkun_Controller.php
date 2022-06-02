<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PengunjungEditAkun_Controller extends Controller
{
    var $location = 'editakun';
    // {{--Profile--}}
    public function edit_profile()
    {
        $data['title'] = "Halaman Edit Profil";
        $uname = session()->get('username');
        $data['title'] = 'Kelola Akun';
        $data['get_data'] = DB::table('user_reg')->where('uname', $uname)->first();
        return view('pengunjung.profil.profile', $data);
    }

    public function edit_akun(Request $request)
    {
        // $max_num =  DB::table('tb_kategori_wisata')->max('id_wisata');
        $uname = session()->get('username');
        $sav_date            = date("Y-m-d H:i:s");
        $get_data = array(
            'uname' => $request->input('username'),
            'Email' => $request->input('email'),
            'Telepon' => $request->input('telp'),
            'Alamat' => $request->input('alamat'),
            'hak_akses' =>  2,
            'updated_at' => $sav_date,
        );

        $pass = $request->post('ubahpass');
        $passV = $request->post('confirmpass');

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

        if ($pass != $passV) {
            return redirect('/pengunjungDashboard/profile');
        } else {
            $get_data = array_merge($get_data, array('pass' =>  $pass));
            $saved = DB::table('user_reg')->where('uname', $uname)->update($get_data);

            $this->update_uname($uname, $request->input('username'));

            if (!$saved) {
                App::abort(500, 'Error');
            } else {
                if (session()->get('username') !=  $request->input('username')) {
                    return redirect('/login')->with('alert-notif', 'Username Anda Telah Diubah, Anda Harus Login Terlebih Dahulu');
                } else {
                    session(['gambar' => $img_loc . $name_img]);
                    session(['username' => $request->input('username')]);
                    return redirect('/pengunjungDashboard/profile');
                }
            }
        }


        // print_r ($get_data);

    }

    public function update_uname($uname, $new_uname)
    {
        // hal ini dilakukan agar tiap uname dalam beberapa table ikut terganti
        DB::table('tb_pesan_komentar')->where('username', $uname)->update(['username' => $new_uname]);
        DB::table('tb_pesan_kontak')->where('username', $uname)->update(['username' => $new_uname]);
        DB::table('tb_transaksi')->where('uname', $uname)->update(['uname' => $new_uname]);
    }
}
