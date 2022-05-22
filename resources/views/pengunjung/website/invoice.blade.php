<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Invoice - Wisata Kediriku </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="{{URL::asset('css/website/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{URL::asset('js/website/bootstrap.min.js')}}"></script>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css"
        integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous">
</head>

<body>

    <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
        <div class="row">
            <div class="receipt-header">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="receipt-left">
                        <img class="img-responsive" alt="iamgurdeeposahan"
                            src="{{URL::asset(session()->get('gambar'))}}"
                            style="width: 71px; border-radius: 43px;">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <div class="receipt-right">
                        <h5>Wisata Kediriku</h5>
                        <p>085x xxxx xxxx <i class="fa fa-phone"></i></p>
                        <p>wisatakediriku@gmail.com <i class="fa fa-envelope"></i></p>
                        <p>Kab. Kediri <i class="fa fa-location-arrow"></i></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="receipt-header receipt-header-mid">
                <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                    <div class="receipt-right">
                        <h5>{{$user->Nama}} </h5>
                        <p><b>No. Hp :</b> {{$user->Telepon}}</p>
                        <p><b>Email :</b> {{$user->Email}}</p>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="receipt-left">
                        <h3>INVOICE # {{$transaksi->id}}</h3>
                        <script>
                            var qrcode = "{{$transaksi->id}}"
                        </script>
                        <div id="qrcode"></div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-md-9">Jumlah Tiket</td>
                        <td class="col-md-3 text-center">{{$transaksi->jumlah_tiket_dewasa+$transaksi->jumlah_tiket_anak}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-9">Jumlah Kendaran</td>
                        <td class="col-md-3 text-center">{{$transaksi->jumlah_mobil+$transaksi->jumlah_motor+$transaksi->jumlah_kendaraan_umum}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-9">Tanggal Masuk</td>
                        <td class="col-md-3">{{date("d/m/Y", strtotime($transaksi->tanggal_kedatangan))}}</td>
                    </tr>

                    <tr>

                        <td class="text-right">
                            <h4><strong>Total: </strong></h4>
                        </td>
                        <td class="text-left text-danger">
                            <h4><strong>Rp. {{$transaksi->gross_amount}},-</strong></h4>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="receipt-header receipt-header-mid receipt-footer">
                <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                    <div class="receipt-right">
                        <p><b>Tanggal :</b> {{date("d-m-Y")}}</p>
                        <h5 style="color: rgb(140, 140, 140);">Terima Kasih Atas Kunjungannya.!</h5>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <style type="text/css">
        /* @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,600;1,100;1,300&display=swap"); */
        * {
            font-family: sans-serif;
        }


        .text-danger strong {
            color: #9f181c;
        }

        .receipt-main {
            background: #ffffff none repeat scroll 0 0;
            border-bottom: 12px solid #333333;
            border-top: 12px solid #9f181c;
            margin-top: 50px;
            margin-bottom: 50px;
            padding: 40px 30px !important;
            position: relative;
            box-shadow: 0 1px 21px #acacac;
            color: #333333;
            font-family: open sans;
        }

        .receipt-main p {
            color: #333333;
            font-family: open sans;
            line-height: 1.42857;
        }

        .receipt-footer h1 {
            font-size: 15px;
            font-weight: 400 !important;
            margin: 0 !important;
        }

        .receipt-main::after {
            background: #414143 none repeat scroll 0 0;
            content: "";
            height: 5px;
            left: 0;
            position: absolute;
            right: 0;
            top: -13px;
        }

        .receipt-main thead {
            background: #414143 none repeat scroll 0 0;
        }

        .receipt-main thead th {
            color: #fff;
        }

        .receipt-right h5 {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 7px 0;
        }

        .receipt-right p {
            font-size: 12px;
            margin: 0px;
        }

        .receipt-right p i {
            text-align: center;
            width: 18px;
        }

        .receipt-main td {
            padding: 9px 20px !important;
        }

        .receipt-main th {
            padding: 13px 20px !important;
        }

        .receipt-main td {
            font-size: 13px;
            font-weight: initial !important;
        }

        .receipt-main td p:last-child {
            margin: 0;
            padding: 0;
        }

        .receipt-main td h2 {
            font-size: 20px;
            font-weight: 900;
            margin: 0;
            text-transform: uppercase;
        }

        .receipt-header-mid .receipt-left h1 {
            font-weight: 100;
            margin: 34px 0 0;
            text-align: right;
            text-transform: uppercase;
        }

        .receipt-header-mid {
            margin: 24px 0;
            overflow: hidden;
        }

        #container {
            background-color: #dcdcdc;
        }


        canvas {
            height: 70px;
            display: inline-block;
            vertical-align: baseline;
        }

    </style>
    <script type="text/javascript" src="{{URL::asset('js/website/jquery.qrcode.min.js')}}"></script>
    <script src="{{URL::asset('js/website/generate-qrcode.js')}}"></script>
   
</body>

</html>
