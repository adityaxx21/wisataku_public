@extends('layout.index')

@section('container')
    <div class="col-md-12 col-sm-12 box-akun">
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12 content-akun">
                    <h3>Kelola <span class="title">Wisata</span></h3>
                    <div class="col-md-6 col-sm-12  form-group">
                        <a href="/tambahWisata" class="btn btn-success btn-tambah"><i class="fa fa-plus-circle"><span>
                                    Tambah
                                    Wisata</span></i></a>
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
                                    <th>Kategori</th>
                                    <th class="col-alamat">Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php $no = 0;
                            foreach ($data_wisata as $value) {
                                $no++ ?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $value->nama_wisata }}</td>
                                    <td>{{ $value->kategori_wisata }}</td>
                                    <td>{{ $value->alamat }}
                                    </td>
                                    <td>
                                        <a href="/editWisata/{{ $value->id }}" class="btn btn-primary"><i
                                                class="fa fa-pencil"><span>
                                                    Edit</span></i></a>
                                        <form action='/kelolaWisata/delete/{{ $value->id }}' method='post'>
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are You Sure About This ? ')">
                                                <i class="fa fa-trash">
                                                    <span>Hapus</span>
                                                </i>
                                            </button>
                                        </form>
                                            <button type="submit" class="btn btn-primary" onclick="$('#exampleModal{{$no}}').modal('show');"><i
                                                class="fa fa-plus-circle"><span>
                                                    Setup Fasilitas</span></i></button>
                                                    
                                    </td>

                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$no}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Fasilitas Yang
                                                    Tersedia</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="update_fas/{{$value->id_fasilitas_tersedia}}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <h6>Fasilitas Yang Tersedia</h6>
                                                    <?php
                                                        $check="";
                                                    foreach ($fasilitas as $key => $value1) {
                                                        foreach ($pilih_fasilitas as $key1 => $value2) {
                                                            if ($value->id_fasilitas_tersedia == $value2->id_fasilitas_tersedia && $value1->id_fasilitas == $value2->id_fasilitas) {
                                                                $check ="checked";
                                                                break;
                                                            }
                                                            
                                                        } ?>
                                                    <label class="container-check">{{ $value1->nama_fasilitas }}
                                                        <input type="checkbox" name="fasilitas[]" value="{{ $value1->id_fasilitas }}"
                                                            {{ $check }}>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    
                                                    <?php  $check=""; } ?>
                                                    <div class="space20"></div>
                                                </div>                                       
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fa fa-save"><span>
                                                                Simpan</span></i></button>
                                                    <button type="button" class="btn btn-warning reset"><i
                                                            class="fa fa-repeat"><span>Reset</span></i></button>
                                                </div>
                                            </form>
                                               
                                        </div>
                                    </div>
                                </div>
                                @php
                            }
                        @endphp
                             
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script src="js/formUpload/keola_wisata.js"></script>
    {{-- open_fasilitas($value->$id_fasilitas_tersedia,) --}}
@endsection
