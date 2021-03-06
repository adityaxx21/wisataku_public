<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaQr_Controller extends Controller
{

    var $location = 'KelolaQr';
    public function kelola_QR()
    {
        $data['title'] = "Kelola QR";
        return view("operatorpage.operator_page.homeOperator", $data);
    }
    public function detail_data($id)
    {
        // proses pembacaan data dilakukan dengan mengkonvert qr code yang berisi id transaksi 
        $data['title'] = "Kelola QR";
        $data["data"] = DB::table('tb_transaksi')
        ->selectRaw('tb_transaksi.*,user_reg.Nama as nama_pemesan')
        ->leftJoin('user_reg', 'user_reg.uname', '=', 'tb_transaksi.uname')
        ->where('tb_transaksi.id', $id)
        ->first();

        // pencrian tanggal dilakukan dengan compare 2 tanggal saat ini dan tanggal kedatangan
        $data['date'] = date("d-m-Y", strtotime($data["data"]->tanggal_kedatangan));
        $date = date("Y-m-d", strtotime( $data['date']));;
        $data['date_now'] = date('d-m-Y');
        $date_now =date('Y-m-d');


        if ( $date > $date_now) {
           $data['status'] = '<br> <span class="info-tagihan"><i class="fa fa-info-circle"></i>Tanggal belum sesuai ketentuan</span>';
           $data['hidden'] = true;
        } elseif ( $date == $date_now) {
            $data['status'] = '<br> <span class="bayar-sukses"><i class="fa fa-info-circle"></i>Tanggal sudah sesuai bisa dilakukan konfirmasi</span>';
            $data['hidden'] = false;
        } elseif ( $date < $date_now) {
            $data['status'] = '<br> <span class="bayar-gagal"><i class="fa fa-info-circle"></i>Tanggal sudah terlewat, konfirmasi tidak dapat dilakukan</span>';
            $data['hidden'] = true;
        }
        // output berupa detail data dlam bentuk json dan ditampilkan dalam  ajax
        return response()->json($data);
   
    }


    public function post_QR(Request $request)
    {
        // proses input merubah apakah user sudah datang atau belum 1 berarti blum dan 0 sebaliknya
        // proses ini mengubah 1 menjadi 0
       $input_id = $request->input('scanner');
       $is_attend = $request->input('status_pem');
       DB::table('tb_transaksi')->where('id', $input_id)->update(['is_attend'=>0]);
       return $is_attend == 0 ? redirect(url('/QrTransaksi'))->with('alert-success', 'Selamat Transaksi Anda Terverifikasi') : redirect(url('/QrTransaksi'))->with('alert-failed', 'Anda Belum Melakukan Pembayaran, Mohon Lakukan Pembayaran Terlebih Dahulu');
        // return view('/QrTransaksi',44);
    }

}
