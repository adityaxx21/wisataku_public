@extends('layout.index')

@section('container')
    <div class="box tambahAkun">
        <h3>Edit <span class="title akun">Kategori</span></h3>
        <form action="/editKategori" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-upload">
                <div class="row">
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="nama" class="label-form">Gambar</label>
                        <div class="form-group upfile">
                            <input type="file" name="gambar" id="actual-btn" hidden />
                            <label for="actual-btn">Pilih File</label>
                            <span id="file-chosen">Tidak ada file</span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="namaKategori" class="label-form">Nama Kategori</label>
                        <input type="text" name="namaKategori" placeholder="Nama Kategori" class="form-control" requiredid="namaKategori" value="{{$kategori->nama_wisata}}">
                    </div>
                </div>
            </div>
            <div class="button-form">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"><span> Simpan</span></i></button>
                <button type="button" class="btn btn-warning reset"><i class="fa fa-repeat"><span>
                            Reset</span></i></button>
                <a href="/kelolaKategori" class="btn btn-danger"><i class="fa fa-close"><span> Kembali</span></i></a>
            </div>
            
        </form>
    </div>


    <script src="js/adminPage/formUpload/script.js"></script>
    {{-- <script src="js/layout/custom.js"></script> --}}
    
@endsection
