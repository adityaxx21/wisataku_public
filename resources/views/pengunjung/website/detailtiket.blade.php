@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="x_content">
            <h3>Detail <span class="title">Tiket</span></h3>
            <a href="/invoice/{{$transaksi->id}}" target="_blank" class="btn btn-danger btn-cetak mt-3"><i
                    class="fa-solid fa-print mr-2"></i><span>Cetak</span></a>
            <div class="box">
                <center>
                    <div class="row mt-5">
                        <div class="col-md-3 col-sm-12 mb-5">

                            <div id="qrcode"></div>


                        </div>
                        <div class="col-md-6 col-sm-12">
                            <table id="tabelku" class="table table-striped table-bordered table-detail" style="width:100%">
                                <tbody>
                                    <tr>
                                        <td>Nama Pemesan</td>
                                        <td>{{ $transaksi->uname }}</td>
                                    </tr>

                                    <tr>
                                        <td>Jumlah Tiket</td>
                                        <td>{{ $transaksi->jumlah_tiket_dewasa + $transaksi->jumlah_tiket_anak }}</td>
                                    </tr>

                                    <tr>
                                        <td>Jumlah Kendaraan</td>
                                        <td>{{ $transaksi->jumlah_motor + $transaksi->jumlah_mobil + $transaksi->jumlah_kendaraan_umum }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Tanggal Masuk</td>
                                        <td>{{ date('d/m/Y', strtotime($transaksi->tanggal_kedatangan)) }}</td>
                                    </tr>




                                </tbody>
                            </table>


                        </div>


                        <script>
                            var qrcode = '{{ $transaksi->id }}';
                        </script>
                        



                    </div>
                </center>
            </div>

        </div>
    </div>

    @push('qrcode-generator')
        <script type="text/javascript" src="{{ URL::asset('js/website/jquery.qrcode.min.js') }}"></script>
        <script src="{{ URL::asset('js/website/generate-qrcode.js') }}"></script>
    @endpush
@endsection
