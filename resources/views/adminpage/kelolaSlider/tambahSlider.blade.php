@extends('layout.index')

@section('container')
    <div class="box tambahAkun">
        <h3>Tambah <span class="title akun">Sliders</span></h3>
        <form  method="POST" action="/tambahSlider" enctype="multipart/form-data">
            @csrf
            <div class="form-upload">
                <div class="row">
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="nama" class="label-form">Gambar</label>
                        <div class="form-group upfile">
                            <input type="file" id="actual-btn" hidden name="gambar"/>
                            <label for="actual-btn">Pilih File</label>
                            <span id="file-chosen">Tidak ada file</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-form">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"><span> Simpan</span></i></button>
                <button type="button" class="btn btn-warning reset"><i class="fa fa-repeat"><span>
                            Reset</span></i></button>
                <a href="/kelola360" class="btn btn-danger"><i class="fa fa-close"><span> Kembali</span></i></a>
            </div>
            
        </form>
    </div>


    <script src="js/adminPage/formUpload/script.js"></script>
    {{-- <script src="js/layout/custom.js"></script> --}}
    
@endsection
