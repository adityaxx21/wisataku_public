@extends('layout.index')

@section('container')
    <div class="col-md-12 col-sm-12 box-akun">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js">
            var date = "";
        </script>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12 content-akun">
                    <h3>Pesan <span class="title">Komentar</span></h3>
                    <script></script>
                    <form action="/pesanKomentar" method="GET" id="find">
                        @csrf 
                        <div class="card-box table-responsive">
                            <label>Search: <input type="search" class="form-control input-sm" placeholder=""
                                    aria-controls="datatable-fixed-header" id="search" name="search" value="{{isset($search) ? $search : '' }}"></label>
                            <input id="date-picker" class="date-picker form-control" placeholder="dd-mm-yyyy"
                                type="date" required="required" onfocus="this.type='date'" onclick="this.type='date'"
                                onkeyup="" name="date"  value="{{ isset($date) ? $date : '' }}">
                            <script>
                                function timeFunctionLong(input) {
                                    setTimeout(function() {
                                        input.type = 'text';
                                    }, 60000);
                                }
                            </script>
                            <a href="javascript:void(0)" onclick="alert(getRandomArbitrary(0,255))"><i
                                    class="fa fa-download download"></i></a>
                            <a href="javascript:void(0)" onclick="$('#find').submit()"><i
                                    class="fa fa-search download"></i></a>
                            <a href="javascript:void(0)" onclick=" location.replace('/pesanKomentar')"><i
                                    class="fa fa-refresh download"></i></a>
                    </form>
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
                                <td>{{ $key + 1 }}</td>
                                <td>{{ date('d/m/Y', strtotime($value->created_at)) }}</td>
                                <td>{{ $value->nama_wisata }}</td>
                                <td>{{ $value->username }}</td>
                                <td>{{ $value->rating }}</td>
                                <td>{{ $value->pesan }}</td>
                                <td>
                                    <a href="/balasKomentar/{{ $value->id_pesan_komentar }}" type="button"
                                        class="btn btn-success"><i class="fa fa-paper-plane"><span>
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

    <script src="js/pesanKomentar/script.js"></script>

    </div>
@endsection
