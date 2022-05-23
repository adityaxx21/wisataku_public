@extends('layout.index')

@section('container')
    <div class="col-md-12 col-sm-12 box-akun">
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12 content-akun">
                    <h3>Laporan <span class="title">Transaksi </span></h3>
                    <div class="card-box table-responsive">
                        <div class="box-chart">
                            <label><input type="search" class="form-control input-sm" placeholder="Nama Wisata"
                                    aria-controls="datatable-fixed-header" id="search"></label>
                            <input id="date-picker" class="date-picker form-control laporanTransaksi"
                                placeholder="dd-mm-yyyy" type="date" required="required" onfocus="this.type='date'"
                                onclick="this.type='date'">
                                
                            <script type="text/javascript">
                                var chart_data = [];
                                var chart_data1 = [];
                            </script>
                            @foreach ($total_transaksi as $key => $item)
                                <script>
                                    chart_data[{{ $key }}] = {{$item}};
                                </script>
                            @endforeach

                            @foreach ($bejibun as $key => $item)
                                <script>
                                    chart_data1[{{ $key }}] = {{$item}};
                                   
                                </script>
                            @endforeach


                            <script>
                                function timeFunctionLong(input) {
                                    setTimeout(function() {
                                        input.type = 'text';
                                    }, 60000);
                                }
                                window.onload(passVar(chart_data1));
                            </script>
                            <a href="javascript:void(0)" onclick="alert(chart_data)"><i class="fa fa-download download" ></i></a>
                            <select id="jenisLaporan" name="jenisLaporan" class="form-control jenisLaporan" required="">
                                <option value=""></option>
                                <option value="minggu">Mingguan</option>
                                <option value="bulan">Bulanan</option>
                                <option value="Tahun">Tahunan</option>
                            </select>
                            <canvas id="myChart" class="myChart"></canvas>
                        </div>
                        <table id="tabelku" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th>Nama wisata</th>
                                    <th>Alamat Wisata</th>
                                    <th>Jumlah Pengunjung</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Nama Pembeli</th>
                                    <th>Aksi</th>


                                </tr>
                            </thead>


                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Simpang Lima Gumul</td>
                                    <td>Kabupaten Kediri</td>
                                    <td>2</td>
                                    <td>11/12/2022</td>
                                    <td>Yolanda</td>

                                    <td>
                                        <a href="#" type="button" class="btn"><i class="fa fa-pencil"
                                                style="color: rgb(27, 193, 27)"></i></a>
                                        <a href="#" type="button" class="btn"><i class="fa fa-trash"
                                                style="color: red"></i></a>
                                    </td>

                                </tr>


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