<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengunjungKomentar_Controller extends Controller
{
    // {{--Komentar--}}
    public function riwayat_komentar()
    {
        // menampilkan komentar
        $data['title'] = "Halaman Riwayat Komentar";
        $data['pesan'] = DB::table('tb_pesan_komentar')
            ->selectRaw('tb_pesan_komentar.*,tb_tambah_wisata.nama_wisata as nama_wisata')
            ->leftJoin('tb_tambah_wisata', 'tb_tambah_wisata.id', '=', 'tb_pesan_komentar.id_wisata')
            ->where(array(
                ['no_pesan', "=", '1'],
                ['username', '=', session()->get('username')]
            ))
            ->get();

        return view('pengunjung.komentar.riwayatkomentar', $data);
    }
    public function hapus_pesan_komentar($id)
    {
        // menghapus komentar
        $get_data = array(
            'pesan' => '',
            'rating' => ''
        );
        DB::table('tb_pesan_komentar')->where('id_pesan_komentar', $id)->update($get_data);
        DB::table('tb_pesan_komentar')->where(array(
            ['id_pesan_komentar', "=", $id],
            ['no_pesan', ">", 1]
        ))->delete();
        return redirect('/pengunjungDashboard/komentar');
    }

   
}
