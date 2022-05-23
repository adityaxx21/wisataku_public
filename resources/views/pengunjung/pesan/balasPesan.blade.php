@extends('pengunjung.layout.homePengunjung')
@section('pengunjung')
    <div class="box tambahAkun">
        <h3>Balas Pesan<span class="title akun">Kontak</span></h3>
    <form action="/balasKontak/{{$header_pesan->id_pesan_kontak}}" method="post" > 
            @csrf
            <div class="form-upload">
                <div class="row">
                    <input type="hidden" name="id_pesan" value="{{$header_pesan->id_pesan_kontak}}">
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="tanggalKomentar" class="label-form">Tanggal</label>
                        <input type="text" name="tanggalPesan" placeholder="tanggal pesan" class="form-control" value="{{date("d/m/Y", strtotime($header_pesan->created_at)) }}" required disabled>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="namaPengirim" class="label-form">Pengirim</label>
                        <input type="text" name="namaPengirim" placeholder="Nama Pengirim Komentar" class="form-control" value="{{$header_pesan->username}}" required disabled>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="email" class="label-form">Email</label>
                        <input type="email" name="email" placeholder="Email Pengguna" class="form-control" value="{{$header_pesan->email}}" required disabled>
                    </div>
                    <?php
                    foreach ($pesan as $key => $value) {
                    ?>
                    @if ($value->hak_akses == 0)
                    <div class="col-md-12 col-sm-12  form-group float-right">
                        <label for="komentar" class="label-form float-right">Balas Pesan Admin</label>
                        <input type="text" name="komentar" value="{{$value->pesan}}" class="form-control"  required readonly>
                    </div>
                    @endif
                    @if ($value->hak_akses == 2)
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="komentar" class="label-form">Pesan {{$value->username}}</label>
                        <input type="text" name="komentar" value="{{$value->pesan}}" class="form-control"  required readonly>
                    </div> 
                    @endif

                    <?php
                    }
                    ?>
                    <div class="col-md-12 col-sm-12  form-group">
                        <textarea class="resizable_textarea form-control" name="balasanPesan" placeholder="balas Pesan"></textarea>
                    </div>

                    

                </div>
            </div>
            <div class="button-form">
                <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"><span> Balas</span></i></button>
                <button type="button" onclick="location.reload()" class="btn btn-warning reset"><i class="fa fa-repeat"><span>
                            Reset</span></i></button>
                <a href="/pengunjungDashboard/pesan" class="btn btn-danger"><i class="fa fa-close"><span> Kembali</span></i></a>
            </div>
            
        </form>
    </div>


    <script src="js/pengunjung/script.js"></script>
    {{-- <script src="js/layout/custom.js"></script> --}}
    
@endsection
