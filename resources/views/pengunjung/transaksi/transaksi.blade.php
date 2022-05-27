@extends('pengunjung.layout.homePengunjung')
@section('pengunjung')
    <div class="box pengunjung mb-5">
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Riwayat <span class="title">Transaksi</span></h3>

                    <div class="col-md-12 col-sm-12  form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="search" class="form-control input-sm " placeholder="Search"
                            aria-controls="datatable-fixed-header">
                    </div>
                    <div class="card-box table-responsive">
                        <table id="tabelku" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th>Invoice</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Email</th>
                                    <th>Wisata</th>
                                    <th>Jumlah Orang</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>



                            <tbody>
                                @foreach ($data_wisata as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->wisata }}</td>
                                        <td>{{ $item->jumlah_tiket_dewasa + $item->jumlah_tiket_anak }}</td>
                                        <td>Rp. {{ $item->gross_amount }}</td>
                                        <td>
                                            <span id="{{ $item->status }}" class="{{ $item->span_class }}"><i
                                                    class="{{ $item->i_class }}"></i>&nbsp;{{ $item->status }}</span>
                                            {{-- <span id="sukses" class="status btn btn-success "><i
                                                    class="fa fa-check-circle"></i>&nbsp; Sukses</span>
                                            <span id="pending" class="status btn btn-pending "><i
                                                    class="fa fa-refresh"></i>&nbsp;Pending</span> --}}


                                        </td>
                                        <td>
                                            <a href="/pengunjungDashboard/detail/{{ $item->id }}"
                                                class="btn btn-primary "><span>
                                                    Detail</span></a>
                                            @if ($item->id_status_pemb == 0)
                                                <a href="/pengunjungDashboard/ulas/{{ $item->id }}" type="button"
                                                    class="btn btn-warning "><span>
                                                        Ulas</span></a>
                                            @else
                                            <a href="/pengunjungDashboard/hapus/{{ $item->id }}" type="button"
                                                class="btn btn-danger"><i class="fa fa-trash"><span>
                                                        Hapus</span></i></a>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('datatable')
        <script>
            var table = $('#tabelku').DataTable();

            // #myInput is a <input type="text"> element
            $('.input-sm').on('keyup', function() {
                var value = $('.input-sm').val();
                table.search(this.value).draw();
                console.log(value);
            });
        </script>
    @endpush

    <script src="js/pengunjung/script.js"></script>
@endsection
