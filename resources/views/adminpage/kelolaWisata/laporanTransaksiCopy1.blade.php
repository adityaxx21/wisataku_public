@extends('layout.index')

@section('container')
    <div class="col-md-12 col-sm-12 box-akun">
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12 content-akun">
                    <h3>Laporan <span class="title">Transaksi </span></h3>
                    </table>
                    <div class="card-box table-responsive">
                        <div class="box-chart">

                            <form id="submit_it">
                                @csrf
                                <label><input type="search" class="form-control im-search" placeholder="Nama Wisata"
                                        aria-controls="datatable-fixed-header" id="search" name="search"></label>
                                <input id="date-picker" class="date-picker form-control laporanTransaksi"
                                    placeholder="dd-mm-yyyy" type="date" required="required" name="date">

                                <script type="text/javascript">
                                    var chart_data = [];
                                    // var date = [];
                                    var year = [];
                                    var a = '{{ isset($jenisLaporan) ? $jenisLaporan : 'minggu' }}';

                                    function getRandomArbitrary(min, max) {
                                        return Math.trunc(Math.random() * (max - min) + min);
                                    }
                                </script>
                                @if (isset($total_transaksi))
                                    @foreach ($total_transaksi as $key => $item)
                                        <script>
                                            chart_data[{{ $key }}] = {{ $item }};
                                        </script>
                                    @endforeach
                                @endif

                                @if (isset($year))
                                    @foreach ($year as $key => $item)
                                        <script>
                                            year[{{ $key }}] = {{ $item }};
                                        </script>
                                    @endforeach
                                @endif



                                <script>
                                    // alert(chart_data);
                                    function timeFunctionLong(input) {
                                        setTimeout(function() {
                                            input.type = 'text';
                                        }, 60000);
                                    }
                                    // function onloading() {
                                    //     passVar(chart_data1);
                                    // }
                                </script>

                                <a href="/downloadLaporan"><i class="fa fa-download download"></i></a>
                                <a href="javascript:void(0)" onclick="get_it()"><i class="fa fa-search download"></i></a>
                                <a href="/laporanTransaksi"><i class="fa fa-refresh download"></i></a>
                                <select id="jenisLaporan" name="jenisLaporan" class="form-control jenisLaporan" required="">

                                    <option value="Mingguan">
                                        Mingguan
                                    </option>
                                    <option value="Bulanan" {{ $jenisLaporan == 'Bulanan' ? 'selected' : null }}>Bulanan
                                    </option>
                                    <option value="Tahunan">Tahunan
                                    </option>

                                </select>
                                <input type="text" id="cavas_here" name="cavas_here" hidden>
                                <img id="img_here" alt="" srcset="">

                                <canvas id="myChart" class="myChart"></canvas>

                        </div>
                        </form>
                        <table id="tabelku" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th>Nama wisata</th>
                                    <th>Alamat Wisata</th>
                                    <th>Jumlah Pengunjung</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Nama Pembeli</th>


                                </tr>
                            </thead>


                            <tbody id="fill_me">
                                @foreach ($transaksi as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->nama_wisata }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->jumlah_tiket_dewasa + $item->jumlah_tiket_anak }}</td>
                                        <td>{{ date('D, d/M/Y', strtotime($item->tanggal_kedatangan)) }}</td>
                                        <td>{{ $item->uname }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function get_it() {
                $.ajax({
                    type: 'GET',
                    url: "/laporanTransaksi/cari_data",
                    data: {
                        "date": $('#date-picker').val(),
                        "search": $('#search').val(),
                        "jenisLaporan": $('#jenisLaporan').val(),
                        "cavas_here": $('#cavas_here').val()
                    },
                    success: function(data) {
                        var a =0;
                        if ($.isEmptyObject(data.error)) {
                            a = data.jenisLaporan;
                            chart_data = [];
                            $.each(data.total_transaksi, function(index, value) {
                                chart_data[index] = value
                            });


                            var table = $("#tabelku").DataTable();;
                            table.clear().draw();
                            $.each(data.transaksi, function(index, value) {
                                table.row.add([
                                    index + 1,
                                    value.nama_wisata,
                                    value.alamat,
                                    value.jumlah_tiket_dewasa + value.jumlah_tiket_anak,
                                    data.date_show[index],
                                    value.uname]).draw();
                            });
                            // update_chart(chart_data);
                            if ( $('#jenisLaporan').val() != data.jenisLaporan) {
                                alert(chart_data);
                                get_it(); 
                            }
                            window.reload();
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            }

            
        </script>
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script> --}}
    <script src="js/laporanTransaksi/script.js"></script>
@endsection
