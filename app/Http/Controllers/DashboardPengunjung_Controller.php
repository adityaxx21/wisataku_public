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
        // Digunakan untuk memanggil jumlah tiap data dari tiap" table dalam halaman dashboard pengunjung, yang mana merupakan halaman transaksi
        // parameter penggunaan dengan session yang menyimpan username untuk kondisi where dalam table
        // table sendiri dipakai dengna left join dengan mengkombinasikan id yang sama untuk table tertentu
        $data['title'] = "Halaman Dashboard Pengunjung";
        $data['status'] = DB::table('tb_status_transaksi')->get();
        $data['transaksi'] = DB::table('tb_transaksi')->where('uname', session()->get('username'))->get();
        $data['data_wisata'] = DB::table('tb_transaksi')
            ->selectRaw('tb_transaksi.*,tb_transaksi.created_at as tanggal,user_reg.Email as email,tb_status_transaksi.*,tb_tambah_wisata.nama_wisata as wisata')
            ->leftJoin('user_reg', 'user_reg.uname', '=', 'tb_transaksi.uname')
            ->leftJoin('tb_status_transaksi', 'tb_status_transaksi.id_status', '=', 'tb_transaksi.id_status_pemb')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_transaksi.id_wisata')
            ->where([['tb_transaksi.uname', session()->get('username')], ['tb_transaksi.is_deleted', 1]])
            ->groupBy('tb_transaksi.id')
            ->get();
        // print_r( $data['data_wisata']);
        return view('pengunjung.transaksi.transaksi', $data);
    }

    public function update($id)
    {
        //menyimpan id transaksi pada session untuk halaman detail
        session(['glob_id' => $id]);
        return redirect('/pengunjungDashboard/detail');
    }
    public function update_i($id)
    {
        //menyimpan id transaksi pada session untuk halaman ulasan
        session(['glob_id' => $id]);
        return redirect('/pengunjungDashboard/ulas');
    }

    //Detail Transaksi
    public function detail()
    {
        //bagian ini dipakai untuk memproses transaksi di mana id yang dipakai merupakan id yang disimpan dalam session  
        $id = session()->get('glob_id');
        $data['title'] = "Halaman Dashboard Detail";
        //sma seperti sebelumbya data disimpan dalam variabel transaksi dengan leftjoin
        $data['transaksi'] = DB::table('tb_transaksi')
            ->selectRaw('tb_transaksi.*,tb_transaksi.id as id_transaksi,tb_transaksi.created_at as tanggal,user_reg.Email as email,user_reg.Telepon as telepon,tb_status_transaksi.*,tb_status_transaksi.deskripsi as deskripsi_status,tb_tambah_wisata.*')
            ->leftJoin('user_reg', 'user_reg.uname', '=', 'tb_transaksi.uname')
            ->leftJoin('tb_status_transaksi', 'tb_status_transaksi.id_status', '=', 'tb_transaksi.id_status_pemb')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_transaksi.id_wisata')
            ->where('tb_transaksi.id', $id)
            // ->groupBy('tb_transaksi.id')
            ->first();
        //proses dibawah dipakai untuk membuat json dalam mitrands demi mendapatkan detail - detail dari biaya dan nama barang transaksinya
        $data['no_invoice'] = $id;
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
        //untuk penjelasan ini bisa dibaca di website resmi karena dibawah ini juga sudah ada keteranganya
        // Set your Merchant Server Key
        //serverkey sandbox = 'SB-Mid-server-HHVxnaKotmFizvbMyeHMi5hA'
        //clientkey sandbox = 'SB-Mid-client-p3ZANgkDvn4BQswk'
        //js sandbox = https://app.sandbox.midtrans.com/snap/snap.jss
        //serverkey production = 'Mid-client-uyb5rEus3lvtOYH-'
        //clientkey production = 'Mid-server-PdcfAopvqbjNANEmps76DNUj'
        //js production = https://app.midtrans.com/snap/snap.js
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
        //proses dibawah ini adalah setelah melakukan pembayaran jika transaksi sudah dibayar maka status pembayaran akan menjadi 0 dan akan muncul pesan bahwa sudah terbayar
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
        if ($get_data['id_status_pemb'] == 0) {
            DB::table('tb_tambah_wisata')->whereId(DB::table('tb_transaksi')->where('id', $id)->value('id_wisata'))->increment('terjual');
            DB::table('tb_pesan_komentar')->where('id_transaksi', $id)->update(['no_pesan' => 1]);
        }
        $order = DB::table('tb_transaksi')->where('tb_transaksi.id', $id)->update($get_data);
        return $order ? redirect(url('/pengunjungDashboard/detail'))->with('alert-success', 'Order berhasil dibuat') : redirect(url('/pengunjungDashboard/detail'))->with('alert-failed', 'Terjadi kesalahan');
        // print_r ( $json);

    }

    // Ulas Transaksi
    public function ulas()
    {
        //membuka laman ulas berdasarkan id
        $id = session()->get('glob_id');
        $data['title'] = "Halaman Dashboard Ulas";
        $data['pesan'] = $this->panggil_ulas($id);

        // print_r( $data['pesan']);
        return view('pengunjung.transaksi.ulas', $data);
    }
    public function panggil_ulas($id)
    {
        //menampilkan pesan dari table 
        $data = DB::table('tb_pesan_komentar')
            ->selectRaw('tb_pesan_komentar.*,tb_tambah_wisata.nama_wisata as nama_wisata')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_pesan_komentar.id_wisata')
            ->where('tb_pesan_komentar.id_transaksi', $id)
            ->first();

        return ($data);
    }

    public function ulas_post(Request $request)
    {
        //saat melakukan submit akan diubah sesuai input
        $id = session()->get('glob_id');
        $sav_date            = date("Y-m-d H:i:s");
        $get_data = array(
            "rating" => $request->post('product_rating'),
            "pesan" => $request->post('komentarUlasan'),
            "no_pesan" => 1,
            "updated_at" => $sav_date,

        );

        DB::table('tb_pesan_komentar')->where('id_transaksi', $id)->update($get_data);
        $data = DB::table('tb_pesan_komentar')->where('id_transaksi', $id)->first();
        //digunakan untuk mengubah jumlah ulasan dan rating pada tb_tambah_wisata
        DB::table('tb_tambah_wisata')->whereId($data->id_wisata)->update(array(
            'jumlah_ulasan' => DB::raw('jumlah_ulasan + 1'),
            'rating' => DB::raw('(rating + '.strval($get_data['rating']).')/2'),
        ));
        return redirect('/pengunjungDashboard/ulas');
    }

    public function delete($id)
    {
        //menghapus transaksi dengan softdelete (tanpa menghilangkan data)
        DB::table('tb_transaksi')->where('id', $id)->update(['is_deleted' => 0]);
        return redirect('/pengunjungDashboard/transaksi');
    }
}
