@extends('layout.index')

@section('container')
    <div class="box tambahAkun">
        <h3>Tambah <span class="title akun">360</span></h3>
        <form action="/tambah360" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-upload">
                <div class="row">
                    <div class="col-md-12 col-sm-12  form-group">
                        <label class="label-form">Pilih Wisata</label>
                        <select id="id_wisata" name="id_wisata" class="form-control" required="" >
                            @foreach ($wisata as $item)
                            <option value="{{$item->id}}">{{$item->nama_wisata}}</option>  
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-12 col-sm-12  form-group" hidden>
                        <label for="namaWisata" class="label-form">Nama Wisata</label>
                        <input type="text" name="namaWisata" id="namaWisata" placeholder="Nama Kategori" class="form-control" required
                        id="namaWisata">
                    </div> --}}
                    <div class="col-md-12 col-sm-12  form-group">
                        <label class="label-form">Gambar</label>
                        <div class="form-group upfile">
                            <input type="file" id="actual-btn" name="gambar" hidden  />
                            <label for="actual-btn">Pilih File</label>
                            <span id="file-chosen">Tidak ada file</span>
                        </div>
                    </div>
                    {{-- <label for="id_wisata" class="label-form"></label> --}}


                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="namaWisata" class="label-form">Link 360</label>
                        <input type="link360" name="link360" placeholder="Link" class="form-control" required
                        id="namaWisata">
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
    <script>
        function input(val) {
            $('#namaWisata').val(val);
        }
    </script>

    <script src="js/adminPage/formUpload/script.js"></script>
    {{-- <script src="js/layout/custom.js"></script> --}}
    
@endsection
