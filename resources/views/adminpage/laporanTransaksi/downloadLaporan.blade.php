<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css"
        integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="text-center mt-5">
        <h1>Laporan Transaksi {{ $jenislaporan }}</h1>
        <h1>Wisata Kabupaten Kediri</h1>

        <div class="mt-5 text-left mb-2" style="font-size: 12px">
            <strong>Total tiket terjual = {{ $transaksi->count() }}</strong><br>
            <strong>Total pengujung = $total e sesuai filter</strong>
        </div>
        <table class="table table-bordered mt-2" style="font-size: 12px">
            <thead class="text-center">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Wisata</th>
                    <th scope="col">Alamat Wisata</th>
                    <th scope="col">Jumlah Pengunjung</th>
                    <th scope="col">Tanggal Kunjungan</th>
                    <th scope="col">Nama Pembeli</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->nama_wisata }}</td>
                        <td class="text-center">{{ $item->alamat }}</td>
                        <td class="text-center">{{ $item->jumlah_tiket_dewasa + $item->jumlah_tiket_anak }}</td>
                        <td class="text-center">{{ date('D, d/M/Y', strtotime($item->tanggal_kedatangan)) }}</td>
                        <td class="text-center">{{ $item->uname }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    {{-- <strong style="text-align: left !important;margin-top:20px">Total tiket terjual = {{ $transaksi->count() }}
    <strong style="text-align: left !important;margin-top:20px">Total Pengunjung = {{ $transaksi->count() }} --}}

</body>

</html>
