<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class KelolaAkun_Controller extends Controller
{
    public function keola_akun()
    {
        //menampilkan daftar akun dalam halaman kelola akun
        $data['title'] = 'Kelola Akun';
        $data['get_data'] = DB::table('user_reg')
            ->selectRaw('user_reg.*,tb_level_user.jenis_akses as jenis_akses')
            ->leftJoin('tb_level_user', 'tb_level_user.hak_akses', '=', 'user_reg.hak_akses')
            ->get();

        return view("adminpage.kelolaAkun.kelolaAkun", $data);
    }
    public function tambah_akun()
    {
        //fungsi get dari saat akan menambah akun
        $data['title'] = 'Kelola Akun';
        $data['hak_akses'] = DB::table('tb_level_user')->get();

        return view("adminpage.kelolaAkun.tambahAkun", $data);
    }

    public function create_data(Request $request)
    {  
        //funsi post dari penambahan akun
        $sav_date            =date("Y-m-d H:i:s");
        $get_data = array(
            'Nama' => $request->input('nama'),
            'Email' => $request->input('email'),
            'uname' => $request->input('username'),
            'hak_akses' =>  $request->input('role'),
            'pass' =>$request->input('password'),
            'created_at' => $sav_date,
        );
        DB::table('user_reg')->insert($get_data);


        return redirect('/kelolaAkun');
    }

    public function update($id)
    {
        //menyimpan session id akun
        session(['glob_id' => $id]);
        return redirect('/editAkun');
    }

    public function keola()
    {
        //fungsi get saat akan mengedit akun
        $id = session()->get('glob_id');
        $data['title'] = "Edit Akun";
        $data['akun'] = DB::table('user_reg')->where('id',  $id)->first();
        $data['hak_akses'] = DB::table('tb_level_user')->get();
        // print_r( $data['penginapan']);
        return view("adminpage.kelolaAkun.editAkun", $data);
    }


    public function edit_akun(Request $request)
    {
        // fungsi post edit akun setalah melakukan perbaruan
        $id = session()->get('glob_id');
        $uname = DB::table('user_reg')->where('id',$id)->select('uname','hak_akses')->first();
        $sav_date            =date("Y-m-d H:i:s");
        $get_data = array(
            'Nama' => $request->input('nama'),
            'Email' => $request->input('email'),
            'uname' => $request->input('username'),
            'hak_akses' =>  $request->input('role'),
            'updated_at' => $sav_date,
            'pass' => $request->input('password')
        );
        $saved = DB::table('user_reg')->where('id',$id)->update($get_data);
    //    saat merubah username dan role pada akun diri yang dipakai saat ini, maka user perlu login
        if (!$saved) {
            App::abort(500, 'Error');
        } else {            
            $this->update_uname_roles($uname->uname,$request->input('username'),$request->input('role'));
            $get_data_u = DB::table('user_reg')->where([
                ['uname',"=",session()->get('username')],
                ['hak_akses',"=",session()->get('hak_akses')]])
                ->first();
            if ($get_data_u == null) {
                return redirect('/login')->with('alert-notif', 'Hak Akses atau Username Anda Telah Diubah, Anda Harus Login Terlebih Dahulu');
            } else{
                return redirect('/editAkun');
            }         
            return redirect('/kelolaAkun');
        }
       
    }

    public function delete($id)
    {
        DB::table('user_reg')->where('id', $id)->delete();
        //    echo($id);
        return redirect('/kelolaAkun');
    }

    public function update_uname_roles($uname,$new_uname,$roles)
    {
        //table yang diubah saat update akun
        DB::table('tb_pesan_komentar')->where('username', $uname)->update(['username' => $new_uname]);
        DB::table('tb_pesan_kontak')->where('username', $uname)->update(['username' => $new_uname]);
        DB::table('tb_transaksi')->where('uname', $uname)->update(['uname' => $new_uname]);

        DB::table('tb_pesan_komentar')->where('username', $uname)->update(['hak_akses' => $roles]);
        DB::table('tb_pesan_kontak')->where('username', $uname)->update(['hak_akses' => $roles]);
    }
}
