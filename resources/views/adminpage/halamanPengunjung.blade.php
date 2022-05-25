@extends('layout.index')

@section('container')
    <div class="box tambahAkun">
        <h3>Kelola <span class="title akun">Halaman Pengunjung</span></h3>
        <form action="/halamanPengunjung" method="POST">
            @csrf
            <div class="form-upload">
                <div class="row">

                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="judul" class="label-form">Judul</label>
                        <input type="text" name="judul" placeholder="Judul" class="form-control" required id="judul"
                            value="{{ $halaman->judul }}">
                    </div>


                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="deskripsi" class="label-form">Deskripsi</label>
                        <div class="x_content">
                            <textarea class="form-control" name="deskrisi" id="descr" rows="5">{{ $halaman->deskripsi }}</textarea>
                        </div>
                        <script>
                            function fill_it() {
                                $('#editor-one').bind('keyup change', function(event) {
                                    var currentValue = $(this).html();
                                    $('#descr').val(currentValue);
                                });
                            }
                        </script>
                    </div>




                </div>
            </div>
            <div class="button-form">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"><span> Simpan</span></i></button>
                <button type="button" class="btn btn-warning reset" onclick="document.location.reload(true)"><i
                        class="fa fa-repeat"><span>
                            Reset</span></i></button>
                <a href="" class="btn btn-danger"><i class="fa fa-close"><span> Kembali</span></i></a>
            </div>

        </form>
    </div>

    <script src="js/adminPage/formUpload/script.js"></script>
@endsection
