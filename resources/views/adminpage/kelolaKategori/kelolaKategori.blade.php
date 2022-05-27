@extends('layout.index')

@section('container')
    <div class="col-md-12 col-sm-12 box-akun">
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12 content-akun">
                    <h3>Kelola <span class="title">Kategori</span></h3>
                    <div class="col-md-6 col-sm-12  form-group">
                        <a href="/tambahKategori" class="btn btn-success btn-tambah"><i class="fa fa-plus-circle"><span>
                                    Tambah
                                    Kategori</span></i></a>
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
                                    <th>Gambar</th>
                                    <th class="col-namaKategori">Nama Kategori</th>
                                    <th>Aksi</th>


                                </tr>
                            </thead>


                            <tbody>
                                <?php  $no = 0;
                                foreach ($kategori_wisata  as $value) {
                                    $no++;
                                    ?>

                                <tr>
                                    <td>{{ $no }}</td>
                                    <td><img src="{{ asset("$value->gambar") }}" alt="" width="200px" height="200px"></td>
                                    <td>{{ $value->nama_wisata }}</td>
                                    <td>
                                        <a href="/editKategori/{{ $value->id }}" class="btn btn-primary"><i
                                                class="fa fa-pencil"><span>
                                                    Edit</span></i></a>
                                        <form action='/kelolaKategori/delete/{{ $value->id }}' method='post'>
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
