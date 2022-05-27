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
                        <label class="right-side">Search: <input type="search" class="form-control input-sm "
                                placeholder="" aria-controls="datatable-fixed-header"></label>
                    </div>
                    <div class="card-box table-responsive">
                        <table id="tabelku" class="table table-striped table-bordered" style="width:100%">
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
                                <?php
                                    foreach ($gambar360 as $key => $value) {
                                    ?>

                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->nama_wisata }}</td>
                                    <td><img src="{{ asset("$value->gambar") }}" alt="" width="200px" height="200px"></td>
                                    <td>{{ $value->url_360 }}</td>
                                    <td>
                                        <a href="/edit360/{{ $value->id }}" class="btn btn-primary"><i
                                            class="fa fa-pencil"><span>
                                                Edit</span></i></a>
                                    <form action='/kelola360/delete/{{ $value->id }}' method='post'>
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are You Sure About This ? ')">
                                            <i class="fa fa-trash">
                                                <span>Hapus</span>
                                            </i>
                                        </button>
                                    </form>
                                </td>

                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
