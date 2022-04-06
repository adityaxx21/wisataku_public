@extends('layout.index')

@section('container')
    <div class="col-md-12 col-sm-12 box-akun">
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12 content-akun">
                    <h3>Kelola <span class="title">360</span></h3>
                    <div class="col-md-6 col-sm-12  form-group">
                        <a href="/tambah360" class="btn btn-success btn-tambah"><i class="fa fa-plus-circle"><span>
                            Tambah
                            360</span></i></a>
                    </div>
                    <div class="col-md-6 col-sm-12  form-group ">
                        <label class="right-side">Search: <input type="search" class="form-control input-sm " placeholder=""
                                aria-controls="datatable-fixed-header"></label>
                    </div>
                    <div class="card-box table-responsive">
                        <table id="tambah" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th>Nama Wisata</th>
                                    <th>Gambar</th>
                                    <th>Link 360</th>
                                    <th>Aksi</th>


                                </tr>
                            </thead>


                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Simpang Lima Gumul</td>
                                    <td><img src="https://dummyimage.com/200x100/34a08b/000" alt=""></td>
                                    <td>http://www.google.com/gambar360.jpg
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary"><i class="fa fa-pencil"><span>
                                                    Edit</span></i></button>
                                        <button type="button" class="btn btn-danger"><i class="fa fa-trash"><span>
                                                    Hapus</span></i></button>
                                    </td>

                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Gunung Kelud</td>
                                    <td><img src="https://dummyimage.com/200x100/34a08b/000" alt=""></td>
                                    <td>http://www.google.com/gambar360.jpg
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary"><i class="fa fa-pencil"><span>
                                                    Edit</span></i></button>
                                        <button type="button" class="btn btn-danger"><i class="fa fa-trash"><span>
                                                    Hapus</span></i></button>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
