<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    {{-- <link rel="stylesheet" href="{{ URL::asset('css/website/invoice.css') }}"> --}}

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.esm.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js"></script>

    <title>Invoice</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Staatliches&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100vh;
            display: grid;
            font-family: "Staatliches", cursive;
            /* background: #d83565; */
            color: black;
            font-size: 14px;
            letter-spacing: 0.1em;
        }

        .ticket {
            border: 1px solid rgb(92, 107, 192);
            margin: auto;
            display: flex;
            background: rgb(197, 202, 233);

            /* box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px,
                rgba(0, 0, 0, 0.22) 0px 15px 12px; */
        }

        .left {
            display: flex;
        }

        .image {
            background: white;
            width: 250px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.85;
        }

        .admit-one {
            position: absolute;
            color: darkgray;
            height: 250px;
            padding: 0 10px;
            letter-spacing: 0.15em;
            display: flex;
            text-align: center;
            justify-content: space-around;
            writing-mode: vertical-rl;
            transform: rotate(-180deg);
        }

        .admit-one span:nth-child(2) {
            color: white;
            font-weight: 700;
        }

        .left .ticket-number {
            /* height: 280px; */
            width: 250px;
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
            padding: 5px;
            color: white;
        }

        .ticket-info {
            padding: 10px;
            padding-bottom: 0px !important;
            display: flex;
            flex-direction: column;
            text-align: center;
            justify-content: space-between;
            align-items: center;
        }

        .date {
            border-top: 1px solid gray;
            border-bottom: 1px solid gray;
            padding: 5px 0;
            font-weight: 200;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .date span {
            width: 100px;
        }

        .date span:first-child {
            text-align: left;
        }

        .date span:last-child {
            text-align: right;
        }

        .date .june-29 {
            color: #d83565;
            font-size: 20px;
        }

        .show-name {
            width: 500px;
            font-size: 20px;
            font-family: "Nanum Pen Script", cursive;
            color: #d83565;
        }

        .show-name h1 {
            font-size: 48px;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: #4a437e;
        }

        .time {
            padding: 10px 0;
            color: #4a437e;
            text-align: center;
            display: flex;
            flex-direction: column;
            /* gap: 10px; */
            font-weight: 700;
        }

        .time span {
            font-weight: 400;
            color: gray;
        }

        .left .time {
            font-size: 16px;
        }

        .location {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            padding-top: 8px;
            border-top: 1px solid gray;
        }

        .location .separator {
            font-size: 20px;
        }

        .right {
            height: 100%;
            width: 180px;
            border-left: 1px dashed #404040;
        }

        .right .admit-one {
            color: darkgray;
        }

        .right .admit-one span:nth-child(2) {
            color: gray;
        }

        .right .right-info-container {
            height: 100%;
            padding: 10px 10px 10px 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
        }

        .right .show-name h1 {
            font-size: 18px;
        }

        .barcode {
            height: 100px;
        }

        .barcode img {
            height: 100%;
        }

        .right .ticket-number {
            color: gray;
        }

        canvas {
            height: 100px;
            display: inline-block;
            vertical-align: baseline;
        }

    </style>

</head>

<body onload='screenshot()'>

    {{-- <body> --}}
    <?php use Carbon\Carbon;
    $createdAt = Carbon::parse($transaksi->tanggal_kedatangan); ?>

    <div class="ticket" id="photo">
        <div class="left">
            <div class="image" style="background-image: url('{{ URL::asset($wisata->gambar) }}')">
                {{-- <p class="admit-one">
                    <span>Wisataku</span>
                    <span>Wisataku</span>
                    <span>Wisataku</span>
                </p> --}}
                <div class="ticket-number">
                    <p>
                        #{{ $transaksi->id_wisata }}
                    </p>
                </div>
            </div>
            <div class="ticket-info">
                <p class="date">
                    <span> {{ $createdAt->format('l') }}</span>
                    <span class="june-29">{{ $createdAt->format('j F') }}</span>
                    <span>{{ $createdAt->format('Y') }}</span>
                </p>
                <div class="show-name">
                    <h1>{{ $wisata->nama_wisata }}</h1>
                    <h4>{{ $wisata->alamat }}</h4>
                </div>
                <div class="time">
                    <h3>Buka Mulai Jam {{ $wisata->jamOperasi }} WIB</h3>
                    <h4 style="color: #d83565;font-weight: 800; margin-top:10px;margin-bottom:5px"> cara menggunakan
                        tiket : </h4>
                    <h5 style="font-weight: 100;gap:0px">Tunjukkan tiket ke petugas operator di lapangan untuk scan
                        QR-Code</h5>
                    <p style="font-weight: 800;font-size:.9rem;color: #d83565">*)Pastikan tiket anda belum pernah
                        diverifikasi
                        sebelumnya</p>
                </div>
                <p class="location"><span>wisataku.com</span>
                    <span class="separator"><i class="far fa-smile"></i></span><span>Wisata Kabupaten
                        Kediri</span>
                </p>
            </div>
        </div>
        <center>
            <div class="right">
                {{-- <p class="admit-one">
                <span>ADMIT ONE</span>
                <span>ADMIT ONE</span>
                <span>ADMIT ONE</span>
            </p> --}}

                <div class="right-info-container">
                    <div class="show-name">
                        <h1>Pemesan</h1>
                        <h2>{{ $transaksi->uname }}</h2>
                    </div>
                    <div class="time">
                        <p>Tanggal Kedatangan</p>
                        <h4 style="color: #d83565">{{ $createdAt->format('l, j F Y') }}</h4>
                    </div>
                    <div class="barcode">
                        <script>
                            var qrcode = "{{ $transaksi->id }}"
                        </script>
                        <div id="qrcode" class="qrcode"></div>
                    </div>
                    <p class="ticket-number">
                        #20030220
                    </p>
                </div>
            </div>
        </center>
    </div>
</body>

<script type="text/javascript">
    function screenshot() {
        html2canvas(document.getElementById("photo")).then(function(canvas) {
            downloadImage(canvas.toDataURL(), "Tiket Wisata {{ $transaksi->uname }}.png");
        });
    }

    function downloadImage(uri, filename) {
        var link = document.createElement('a');
        if (typeof link.download !== 'string') {
            window.open(uri);
        } else {
            link.href = uri;
            link.download = filename;
            accountForFirefox(clickLink, link);
        }
    }

    function clickLink(link) {
        link.click();
    }

    function accountForFirefox(click) {
        var link = arguments[1];
        document.body.appendChild(link);
        click(link);
        document.body.removeChild(link);
    }
</script>

<script type="text/javascript" src="{{ URL::asset('js/website/jquery.qrcode.min.js') }}"></script>
<script src="{{ URL::asset('js/website/generate-qrcode.js') }}"></script>

</html>
