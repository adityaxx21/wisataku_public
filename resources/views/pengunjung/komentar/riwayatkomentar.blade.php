@extends('pengunjung.layout.homePengunjung')
@section('pengunjung')
    <div class="box pengunjung mb-5">
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Riwayat <span class="title">Komentar</span></h3>

                    <div class="card-box table-responsive">
                        <table id="tabelku" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th>Tanggal</th>
                                    <th>Wisata</th>
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
                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                    <td>{{ $value->nama_wisata }}</td>d
                                    <td>{{ $value->rating }}</td>
                                    <td>{{ $value->pesan }}</td>
                                    <td>
                                        <a href="/hapusPesanKomentar/{{ $value->id_pesan_komentar }}" class="btn btn-danger"><i
                                                class="fa fa-trash"><span>
                                                    Hapus</span></i></a>
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


    <script src="js/pengunjung/script.js"></script>
@endsection
