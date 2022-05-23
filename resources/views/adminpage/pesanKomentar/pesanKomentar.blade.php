@extends('layout.index')

@section('container')
    <div class="col-md-12 col-sm-12 box-akun">
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12 content-akun">
                    <h3>Pesan <span class="title">Komentar</span></h3>
                    <div class="card-box table-responsive">
                        <label>Search: <input type="search" class="form-control input-sm" placeholder=""
                                aria-controls="datatable-fixed-header" ></label>
                        <input id="date-picker" class="date-picker form-control" placeholder="dd-mm-yyyy" type="date"
                            required="required" onfocus="this.type='date'" onclick="this.type='date'" value="{{ (new DateTime())->format('d-m-Y'); }}">
                        <script>

                            function timeFunctionLong(input) {
                                setTimeout(function() {
                                    input.type = 'text';
                                }, 60000);
                            }
                        </script>
                        <table id="tabelku" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th>Tanggal</th>
                                    <th>Nama wisata</th>
                                    <th>Nama Pengunjung</th>
                                    <th>Rating</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>


                                </tr>
                            </thead>


                            <tbody>
                                <?php 
                                    foreach ($pesan as $key => $value) {
                                    ?>
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                                    <td>{{$value->nama_wisata}}</td>
                                    <td>{{$value->username}}</td>
                                    <td>{{$value->rating}}</td>
                                    <td>{{$value->pesan}}</td>
                                    <td>
                                        <a href="/balasKomentar/{{$value->id_pesan_komentar}}" type="button" class="btn btn-success"><i class="fa fa-paper-plane"><span>
                                                    Balas Komentar</span></i></a>
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