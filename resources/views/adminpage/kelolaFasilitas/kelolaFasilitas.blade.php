@extends('layout.index')

@section('container')
<div class="col-md-12 col-sm-12 box-akun">    
    <div class="x_content">
        <div class="row">
            <div class="col-sm-12 content-akun">
                <h3>Kelola <span class="title">Fasilitas</span></h3>
                <div class="col-md-6 col-sm-12  form-group">
                    <a href="/tambahFasilitas" class="btn btn-success btn-tambah"><i class="fa fa-plus-circle"><span>
                        Tambah
                        Fasilitas</span></i></a>
                </div>
                <div class="col-md-6 col-sm-12  form-group ">
                    <label class="right-side">Search: <input type="search" class="form-control input-sm " placeholder=""
                            aria-controls="datatable-fixed-header"></label>
                </div>
                <div class="card-box table-responsive">
                    <table id="tabelku" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th>Gambar</th>
                                <th class="col-namaKategori">Fasilitas</th>
                                <th>Aksi</th>


                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><img src="https://dummyimage.com/200x100/34a08b/000" alt=""></td>
                                <td>Kamar Mandi</td>
                                <td>
                                    <button type="button" class="btn btn-primary"><i class="fa fa-pencil"><span>
                                                Edit</span></i></button>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash"><span>
                                                Hapus</span></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><img src="https://dummyimage.com/200x100/34a08b/000" alt=""></td>
                                <td>Wi-Fi</td>
                                <td>
                                    <button type="button" class="btn btn-primary"><i class="fa fa-pencil"><span>
                                                Edit</span></i></button>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash"><span>
                                                Hapus</span></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><img src="https://dummyimage.com/200x100/34a08b/000" alt=""></td>
                                <td>Parkir Luas</td>
                                <td>
                                    <button type="button" class="btn btn-primary"><i class="fa fa-pencil"><span>
                                                Edit</span></i></button>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash"><span>
                                                Hapus</span></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><img src="https://dummyimage.com/200x100/34a08b/000" alt=""></td>
                                <td>Mushola</td>
                                <td>
                                    <button type="button" class="btn btn-primary"><i class="fa fa-pencil"><span>
                                                Edit</span></i></button>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash"><span>
                                                Hapus</span></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><img src="https://dummyimage.com/200x100/34a08b/000" alt=""></td>
                                <td>Tempat Makan</td>
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
