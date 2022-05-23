<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DashboardPengunjung_Controller extends Controller
{
    var $location = 'profileUser';

    // {{--Transaksi--}}
    public function kelola_dashboard_pengunjung()
    {
        $data['title'] = "Halaman Dashboard Pengunjung";
        $data['status'] = DB::table('tb_status_transaksi')->get();
        $data['transaksi'] = DB::table('tb_transaksi')->where('uname', session()->get('username'))->get();
        $data['data_wisata'] = DB::table('tb_transaksi')
            ->selectRaw('tb_transaksi.*,tb_transaksi.created_at as tanggal,user_reg.Email as email,tb_status_transaksi.*,tb_tambah_wisata.nama_wisata as wisata')
            ->leftJoin('user_reg', 'user_reg.uname', '=', 'tb_transaksi.uname')
            ->leftJoin('tb_status_transaksi', 'tb_status_transaksi.id_status', '=', 'tb_transaksi.id_status_pemb')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_transaksi.id_wisata')
            ->where([['tb_transaksi.uname', session()->get('username')], ['tb_transaksi.is_deleted', 1]])
            // ->groupBy('tb_tambah_wisata.id')
            ->get();
        // print_r( $data['data_wisata']);
        return view('pengunjung.transaksi.transaksi', $data);
    }

    public function update($id)
    {
        session(['glob_id' => $id]);
        return redirect('/pengunjungDashboard/detail');
    }
    public function update_i($id)
    {
        session(['glob_id' => $id]);
        return redirect('/pengunjungDashboard/ulas');
    }

    //Detail Transaksi
    public function detail()
    {
        $id = session()->get('glob_id');
        $data['title'] = "Halaman Dashboard Detail";
        $data['transaksi'] = DB::table('tb_transaksi')
            ->selectRaw('tb_transaksi.*,tb_transaksi.id as id_transaksi,tb_transaksi.created_at as tanggal,user_reg.Email as email,user_reg.Telepon as telepon,tb_status_transaksi.*,tb_status_transaksi.deskripsi as deskripsi_status,tb_tambah_wisata.*')
            ->leftJoin('user_reg', 'user_reg.uname', '=', 'tb_transaksi.uname')
            ->leftJoin('tb_status_transaksi', 'tb_status_transaksi.id_status', '=', 'tb_transaksi.id_status_pemb')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_transaksi.id_wisata')
            ->where('tb_transaksi.id', $id)
            // ->groupBy('tb_tambah_wisata.id')
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

        // echo ($data['snapToken']);
        // print_r( $data['transaksi']);
        return view("pengunjung.transaksi.detail", $data);
    }

    public function detail_post(Request $request)
    {
        if (session()->get('username') == "") {
            return redirect('/login')->with('alert-notif', 'Anda Harus Login Terlebih Dahulu');
        }
        $id = session()->get('glob_id');
        $json = json_decode($request->get('json'));
        $sav_date            = date("Y-m-d H:i:s");
        // $status = $json->transaction_status; 

        // $url =
        $get_data = array(
            'id_status_pemb' => $json->transaction_status == 'pending' ? 1 : 0,
            'transaction_id' => $json->transaction_id,
            'order_id' => $json->order_id,
            'payment_type' => $json->payment_type,
            'payment_code' =>  isset($json->payment_code) ? $json->payment_code : null,
            'pdf_url' => isset($json->pdf_url) ? $json->pdf_url : null,
            'updated_at' => $sav_date,
        );
        $order = DB::table('tb_transaksi')->where('tb_transaksi.id', $id)->update($get_data);
        return $order ? redirect(url('/pengunjungDashboard/detail'))->with('alert-success', 'Order berhasil dibuat') : redirect(url('/pengunjungDashboard/detail'))->with('alert-failed', 'Terjadi kesalahan');
        // print_r ( $json);

    }

    // Ulas Transaksi
    public function ulas()
    {
        $id = session()->get('glob_id');
        $data['title'] = "Halaman Dashboard Ulas";
        if ($this->panggil_ulas($id) == null) {
            # code...
        }
        $data['pesan'] = $this->panggil_ulas($id);

        // print_r( $data['pesan']);
        return view('pengunjung.transaksi.ulas', $data);
    }
    public function panggil_ulas($id)
    {
        $data = DB::table('tb_pesan_komentar')
            ->selectRaw('tb_pesan_komentar.*,tb_tambah_wisata.nama_wisata as nama_wisata')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_pesan_komentar.id_wisata')
            ->where('tb_pesan_komentar.id_transaksi', $id)
            ->first();

        return ($data);
    }

    public function ulas_post(Request $request)
    {
        $id = session()->get('glob_id');
        $sav_date            = date("Y-m-d H:i:s");
        $get_data = array(
            "rating" => $request->post('product_rating'),
            "pesan" => $request->post('komentarUlasan'),
            "no_pesan" => 1,
            "updated_at" => $sav_date,

        );
        print_r($get_data);
        DB::table('tb_pesan_komentar')->where('id_transaksi', $id)->update($get_data);
        return redirect('/pengunjungDashboard/ulas');
    }

    public function delete($id)
    {
        DB::table('tb_transaksi')->where('id', $id)->update(['is_deleted' => 0]);
        return redirect('/pengunjungDashboard/transaksi');
    }
}
