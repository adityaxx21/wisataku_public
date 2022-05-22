<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User_Reg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Registrasi_Controller extends Controller
{

    public function login()
    {
        return view("auth.login");
    }
    public function login_process(Request $request)
    {
        Session::flush();
        
        $uname = $request->input('username');
        $user = User_Reg::where('uname', $uname)->first();
        if ($user) {
            $pass = $request->input('password');
            if ($user['pass'] == $pass) {
                session(['username' => $user['uname']]);
                session(['name' => $user['Nama']]);
                session(['gambar' => $user['gambar']]);
                session(['hak_akses' => $user['hak_akses']]);
                if ($user['hak_akses'] == 0) {
                    return redirect('/DasboardAdmin');
                } elseif ($user['hak_akses'] == 1) {
                    return redirect('/QrTransaksi');
                } elseif ($user['hak_akses'] == 2) {
                    return redirect('/');
                }
               
            } else {
                session()->flash('message', 'Invalid Password');
                return redirect('/login');
            }
        } else {
            session()->flash('message', 'Email does not exist.');
            return redirect('/login');
        }
    }

    public function signup()
    {
        return view("auth.registration");
    }

    public function create(Request $request)
    {

        $sav_date            =date("Y-m-d H:i:s");
        $get_data = array(
            'Nama' => $request->input('Nama'),
            'Jenis_Kel' => $request->input('Jenis_Kel'),
            'Alamat' => $request->input('Alamat') ,
            'Telepon' => $request->input('Telepon') ,
            'Email' => $request->input('Email') ,
            'pass' => $request->input('pass') ,
            'uname' => $request->input('uname') ,
            'hak_akses' => 2,
            'created_at' => $sav_date,
        );
        $uname =DB::table('user_reg')->where([['uname',$request->input('uname')],['Email',$request->input('Email')]])->first();
        // print_r($uname);
        $pass = $request->input('pass');
        $passV = $request->input('passV');
        if (isset($uname)) {
            return redirect('/signup')->with('alert-notif', 'Username atau Email anda sudah terdaftar !!!');
        }
        if ($pass != $passV) {
            return redirect('/signup')->with('alert-notif', 'Password dan Password Konfirmasi anda tidak sama !!');
        }else{
            // $get_data=array_merge($get_data, array('pass' =>   $pass));
            // print_r($get_data);
            DB::table('user_reg')->insert($get_data);
            return redirect('/login')->with('alert-notif', 'Pendataran Berhasil');;
        }
            

        // User_Reg::create($get_data);
        // echo ("Hello World");
        
    }

    public function logout(Request $request)
    {
        Session::flush();
        
        // Auth::logout();


        return redirect('/login');
    }



}
