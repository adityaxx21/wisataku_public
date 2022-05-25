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
                            <form action="/laporanTransaksi" method="get" id="find">
                                @csrf
                                <label><input type="search" class="form-control input-sm" placeholder="Nama Wisata"
                                        aria-controls="datatable-fixed-header" id="search" name="search"
                                        value="{{ isset($search) ? $search : '' }}"></label>
                                <input id="date-picker" class="date-picker form-control laporanTransaksi"
                                    placeholder="dd-mm-yyyy" type="date" required="required" onfocus="this.type='date'"
                                    onclick="this.type='date'" name="date" value="{{ $date }}">

                                <script type="text/javascript">
                                    var chart_data = [];
                                    var date = [];
                                    var year = [];
                                    var a = '{{ isset($jenisLaporan) ? $jenisLaporan : 'minggu' }}';

                                    function getRandomArbitrary(min, max) {
                                        return Math.trunc(Math.random() * (max - min) + min);
                                    }
                                </script>
                                @foreach ($total_transaksi as $key => $item)
                                    <script>
                                        chart_data[{{ $key }}] = {{ $item }};
                                    </script>
                                @endforeach
                                @if (isset($year))
                                    @foreach ($year as $key=>$item)
                                        <script>
                                            year[{{ $key }}] = {{ $item }};
                                        </script>
                                    @endforeach
                                @endif



                                <script>
                                    function timeFunctionLong(input) {
                                        setTimeout(function() {
                                            input.type = 'text';
                                        }, 60000);
                                    }
                                    window.onload(passVar(chart_data1));
                                </script>
                                <a href="javascript:void(0)" onclick="alert(getRandomArbitrary(0,255))"><i
                                        class="fa fa-download download"></i></a>
                                <a href="javascript:void(0)" onclick="$('#find').submit()"><i
                                        class="fa fa-search download"></i></a>
                                <a href="javascript:void(0)" onclick=" location.replace('/laporanTransaksi')"><i
                                        class="fa fa-refresh download"></i></a>
                                <select id="jenisLaporan" name="jenisLaporan" class="form-control jenisLaporan" required="">
                                    <option value="minggu" {{ $jenisLaporan == 'minggu' ? 'selected' : null }}>Mingguan
                                    </option>
                                    <option value="bulan" {{ $jenisLaporan == 'bulan' ? 'selected' : null }}>Bulanan</option>
                                    <option value="tahun" {{ $jenisLaporan == 'tahun' ? 'selected' : null }}>Tahunan</option>
                                </select>
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


                            <tbody>
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


    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script> --}}
    <script src="js/laporanTransaksi/script.js"></script>
@endsection
