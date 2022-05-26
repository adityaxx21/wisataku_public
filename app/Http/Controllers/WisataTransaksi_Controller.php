<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class WisataTransaksi_Controller extends Controller
{
    public function detail($id)
    {

        $data["title"] =  "Halaman Wisata";
        $data['wisata'] = DB::table('tb_tambah_wisata')->where('id', $id)->first();
        $data['rating'] = DB::table('tb_pesan_komentar')->where([['id_wisata', $id], ['no_pesan', 1]])->average('rating');
        $data['jumlah'] = DB::table('tb_pesan_komentar')->where([['id_wisata', $id], ['no_pesan', 1]])->count();
        $data['fasilitas'] = DB::table('tb_fasilitas_wisata')->get();
        $data['penginapan'] = DB::table('tb_penginapan')->get();
        $data['kategori_wisata'] = DB::table('tb_kategori_wisata')->get();
        $data['setel_fasilitas'] = DB::table('tb_setel_fasisilitas')->select('id_fasilitas')->where('id_fasilitas_tersedia', $data['wisata']->id_fasilitas_tersedia)->get();
        $data['komentar'] =  DB::table('tb_pesan_komentar')->where([['id_wisata', $id], ['no_pesan', 1]])->get();
        $data['gambar360'] = DB::table('tb_gambar360')->where('id_gambar360',$id)->get();

        // print_r($data['wisata']);
        return view('pengunjung.website.detail', $data);
    }

    public function wisata(Request $request)
    {
        $data['title'] = 'Halaman Wisata';
        $data['kategori'] = DB::table('tb_kategori_wisata')->get();
        $data['range'] = DB::table('tb_range_harga')->get();
        $data['id_wis'] = $request->get('kategoriWisata');
        $data['range_harga'] = $request->get('kategoriHarga');
        $data['nama_wisata'] = $request->get('search');

        $fil_wisata = array();
        if ( $data['id_wis'] != "") {
            $fil_wisata[] = ['id_wisata', $data['id_wis']];
        } if ($data['range_harga'] != "") {
            foreach ($data['range'] as $key => $value) {
                if ($value->label == $data['range_harga']) {
                    $fil_wisata[] = ['tiketDewasa','<', $value->harga_max];
                    $fil_wisata[] = ['tiketDewasa','>=', $value->harga_min];
                    $fil_wisata[] = ['tiketAnak','<', $value->harga_max];
                    $fil_wisata[] = ['tiketAnak','>=', $value->harga_min];
                }
            }
        } if ($data['nama_wisata'] != ""){
            $fil_wisata[] = ['nama_wisata','LIKE', '%'.$data['nama_wisata'].'%'];
        } 
        try {
            $data['wisata'] = DB::table('tb_tambah_wisata')->where($fil_wisata)->get(); 
        } catch (\Throwable $th) {
            $data['wisata'] = DB::table('tb_tambah_wisata')->where([])->get();
        }
        foreach ($data['wisata'] as $key => $value) {
            $rating[$key] = DB::table('tb_pesan_komentar')->where([['id_wisata', $value->id], ['no_pesan', 1]])->average('rating');
            $jumlah[$key] = DB::table('tb_pesan_komentar')->where([['id_wisata', $value->id], ['no_pesan', 1]])->count();
        }
        try {
            $data['jumlah'] = $jumlah;
            $data['rating'] = $rating;
        } catch (\Throwable $th) {
            //throw $th;
        }
        $data['wisata'] = DB::table('tb_tambah_wisata')->where($fil_wisata)->get(); 
        return view('pengunjung.website.kategorinavbar', $data);
    }

    public function carirute($id)
    {
        $data['title'] = 'Halaman Wisata';
        $data['wisata'] = DB::table('tb_tambah_wisata')->where('id', $id)->first();

        return view('pengunjung.website.carirute', $data);
    }

    public function pesantiket($id)
    {
        if (session()->get('username') == "") {
            return redirect('/login')->with('alert-notif','Anda Harus Login Terlebih Dahulu');
        } 
        $data['title'] = 'Pesan Tiket';
        $data['wisata'] = DB::table('tb_tambah_wisata')->where('id', $id)->first();
        return view('pengunjung.website.pesantiket', $data);
    }

    public function pesantiket_post(Request $request, $id)
    {

        $data['wisata'] = DB::table('tb_tambah_wisata')->where('id', $id)->first();
        $get_email = DB::table('user_reg')->where('uname', session()->get('username'))->value('Email');
        $hargaTiket =  $data['wisata']->tiketDewasa * $request->input('tiketdewasa') + $data['wisata']->tiketAnak * $request->input('tiketanak');
        $hargaKendaraan =  $data['wisata']->parkirmotor * $request->input('motor') + $data['wisata']->parkirmobil * $request->input('mobil') + $data['wisata']->parkirumum * $request->input('umum');
        $gross_amount = $hargaTiket + $hargaKendaraan;
        $sav_date            = date("Y-m-d H:i:s");
        $get_data = array(
            'id_wisata' => $id,
            'uname' => session()->get('username'),
            'email' => $get_email,
            'jumlah_tiket_dewasa' => $request->input('tiketdewasa'),
            'jumlah_tiket_anak' => $request->input('tiketanak'),
            'jumlah_motor' => $request->input('motor'),
            'jumlah_mobil' => $request->input('mobil'),
            'jumlah_kendaraan_umum' => $request->input('umum'),
            'gross_amount' => $gross_amount,
            'tanggal_kedatangan' =>  date("Y/m/d", strtotime($request->input('tgldatang'))),
            'catatan' => $request->input('catatan'),
            'created_at' => $sav_date,
        );
        // print_r($get_data);

        DB::table('tb_transaksi')->insert($get_data);
        $get_id = DB::table('tb_transaksi')->max('id');
        $get_data1 = array(
            'id_transaksi' => $get_id,
            'id_wisata' => $id,
            'id_pesan_komentar' => DB::table('tb_pesan_komentar')->max('id_pesan_komentar') + 1,
            'hak_akses' => session()->get('hak_akses'),
            'username' => session()->get('username'),
            'created_at' => $sav_date,
        );
        DB::table('tb_pesan_komentar')->insert($get_data1);
        return redirect('/detailpesanan/' . $get_id);
    }

    public function detailpesanan($id)
    {
        $data['title'] = "Pesan Tiket";
        $data['transaksi'] = DB::table('tb_transaksi')
            ->selectRaw('tb_transaksi.*,tb_status_transaksi.*,user_reg.Alamat as alamat,user_reg.Telepon as telepon,tb_status_transaksi.deskripsi as deskripsi_status,tb_tambah_wisata.*')
            ->leftJoin('user_reg', 'user_reg.uname', '=', 'tb_transaksi.uname')
            ->leftJoin('tb_status_transaksi', 'tb_status_transaksi.id_status', '=', 'tb_transaksi.id_status_pemb')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_transaksi.id_wisata')
            ->where('tb_transaksi.id', $id)
            ->first();
        $data['no_invoice'] = $id;
        // $hargaTiket =  ($data['transaksi']->tiketDewasa*$data['transaksi']->jumlah_tiket_dewasa)+($data['transaksi']->tiketAnak*$data['transaksi']->jumlah_tiket_anak);
        // $hargaKendaraan =  ($data['transaksi']->parkirmotor*$data['transaksi']->jumlah_motor)+($data['transaksi']->parkirmobil*$data['transaksi']->jumlah_mobil)+($data['transaksi']->parkirumum*$data['transaksi']->jumlah_kendaraan_umum);
        $aray = array();
        if ($data['transaksi']->jumlah_tiket_dewasa != 0) {
            $aray[] = [
                'id' => 'a1',
                'price' => $data['transaksi']->tiketDewasa,
                'quantity' => $data['transaksi']->jumlah_tiket_dewasa,
                'name' => 'Jumlah Tiket Dewasa'
            ];
        }
        if ($data['transaksi']->jumlah_tiket_anak != 0) {
            $aray[] = [
                'id' => 'b1',
                'price' => $data['transaksi']->tiketAnak,
                'quantity' => ($data['transaksi']->jumlah_tiket_anak),
                'name' => 'Jumlah Tiket Anak'
            ];
        }
        if ($data['transaksi']->jumlah_motor != 0) {
            $aray[] = [
                'id' => 'c1',
                'price' => $data['transaksi']->parkirmotor,
                'quantity' => $data['transaksi']->jumlah_motor,
                'name' => 'Jumlah Motor'
            ];
        }

        if ($data['transaksi']->jumlah_mobil != 0) {
            $aray[] = [
                'id' => 'd1',
                'price' => $data['transaksi']->parkirmobil,
                'quantity' => $data['transaksi']->jumlah_mobil,
                'name' => 'Jumlah Mobil'
            ];
        }
        if ($data['transaksi']->jumlah_kendaraan_umum != 0) {
            $aray[] = [
                'id' => 'e1',
                'price' => $data['transaksi']->parkirumum,
                'quantity' => ($data['transaksi']->jumlah_kendaraan_umum),
                'name' => 'Jumlah Tiket Anak'
            ];
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-HHVxnaKotmFizvbMyeHMi5hA';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $data['transaksi']->gross_amount,
            ),
            'item_details' => $aray,
            'customer_details' => array(
                'first_name' => $data['transaksi']->uname,
                'email' => $data['transaksi']->email,
                'phone' => $data['transaksi']->telepon,

            ),
        );

        $data['snapToken'] = \Midtrans\Snap::getSnapToken($params);
        // $data['transaksi'] = DB::table('tb_transaksi')->where('order_id',$id)->first();
        // print_r( $params);
        return view('pengunjung.website.detailpesanan', $data);
    }

    public function detailpesanan_post(Request $request, $id)
    {
        if (session()->get('username') == "") {
            return redirect('/login')->with('alert-notif','Anda Harus Login Terlebih Dahulu');
        }
        // $id = session()->get('glob_id');
        $json = json_decode($request->get('json'));
        $sav_date            = date("Y-m-d H:i:s");
        $status = $json->transaction_status; 

        // $url =
        $get_data = array(
            'id_status_pemb' => $status == 'pending' ? 1 : 0,
            'transaction_id' => $json->transaction_id,
            'order_id' => $json->order_id,
            'payment_type' => $json->payment_type,
            'payment_code' =>  isset($json->payment_code) ? $json->payment_code : null,
            'pdf_url' => isset($json->pdf_url) ? $json->pdf_url : null,
            'updated_at' => $sav_date,
        );
        if ($get_data['id_status_pemb'] == 0) {
            DB::table('tb_pesan_komentar')->where('id_transaksi', $id)->update(['no_pesan' => 1]);
        }
        $order = DB::table('tb_transaksi')->where('id', $id)->update($get_data);
        return $order ? redirect(url('/detailtiket/' . $id))->with('alert-success', 'Order berhasil dibuat') : redirect(url('/detailtiket/' . $id))->with('alert-failed', 'Terjadi kesalahan');
        // print_r ( $json);

    }

    

    public function detailtiket($id)
    {
        $data['title'] = "Pesan Tiket";
        $data['transaksi'] = DB::table('tb_transaksi')->where('id', $id)->first();
        // $data['wisata'] = DB::table('tb_tambah_wisata')->where('id', $data['transaksi']->id_wisata)->first();
        // print_r( $data['transaksi']);

        return view('pengunjung.website.detailtiket', $data);
    }

    public function invoice($id)
    {
        $data['user'] = DB::table('user_reg')->where('uname', session()->get('username'))->first();
        $data['transaksi'] =  DB::table('tb_transaksi')->where('id', $id)->first();
        // print_r($data['user']);
        return view('pengunjung.website.invoice', $data);
    }

    // public function search_me(Request $request)
    // {
    //     $data['title'] = "Pencarian";
    //     $data['kategori'] = DB::table('tb_kategori_wisata')->get();
    //     if ($request->get('city')) {
    //         $city = $request->get('city');
    //         $stores->whereHas(
    //             'city',
    //             function ($query) use ($city) {
    //                 $query->where('name', 'LIKE', "%{$city}%");
    //             }
    //         );
    //     } else {
    //     }

    //     // if ($request->get('keyword')) {
    //     //     $stores->search($request->keyword);
    //     // }

    //     return view('pengunjung.website.kategorinavbar',$data);
    // }
}
