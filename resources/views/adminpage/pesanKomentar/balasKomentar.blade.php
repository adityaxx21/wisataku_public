@extends('layout.index')

@section('container')
    <div class="box tambahAkun">
        <h3>Balas <span class="title akun">Komentar</span></h3>
        <form action="balasKomentar" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-upload">
                <div class="row">
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="tanggalKomentar" class="label-form">Tanggal</label>
                        <input type="text" name="tanggalKomentar" placeholder="tanggal komentar" class="form-control"
                            value="{{ date('d/m/Y', strtotime($header_pesan->created_at)) }}" required readonly>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="namaPengirim" class="label-form">Nama Pengirim</label>
                        <input type="text" name="namaPengirim" placeholder="Nama Pengirim Komentar" class="form-control"
                            value="{{ $header_pesan->username }}" required readonly>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="namaWisata" class="label-form">Wisata</label>
                        <input type="text" name="namaWisata" placeholder="Nama Wisata" class="form-control"
                            value="{{ $header_pesan->nama_wisata }}" required readonly>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="rating" class="label-form">Rating</label>
                        <input type="text" name="rating" placeholder="Rating Wisata" class="form-control"
                            value="{{ $header_pesan->rating }}" required readonly>
                    </div>
                    <?php
                    foreach ($pesan as $key => $value) {
                    ?>
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="komentar" class="label-form">Komentar {{ $value->username }}</label>
                        <input type="text" name="komentar" value="{{ $value->pesan }}" class="form-control" required
                            readonly>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group float-right">
                        <label for="komentar" class="label-form float-right" style="margin-right:10%">Balas Komentar
                            Admin</label>
                        <input type="text" name="komentar" value="{{ $value->pesan_balas }}" class="form-control"
                            required readonly>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="col-md-12 col-sm-12  form-group">

                        <textarea class="resizable_textarea form-control" name="balasanKomentar" placeholder="balasan komentar"
                            id="balasKomentar"></textarea>
                    </div>



                </div>
            </div>
            <div class="button-form">
                <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"><span> Balas</span></i></button>
                <button type="button" class="btn btn-warning reset" onclick="document.location.reload(true)"><i
                        class="fa fa-repeat"><span>
                            Reset</span></i></button>
                <a href="/pesanKomentar" class="btn btn-danger"><i class="fa fa-close"><span> Kembali</span></i></a>
            </div>

        </form>
    </div>


    <script src="js/adminPage/formUpload/script.js"></script>
    {{-- <script src="js/layout/custom.js"></script> --}}
@endsection
