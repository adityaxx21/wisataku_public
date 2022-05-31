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
        <h1>Data Pesan Komentar</h1>
        <h1>Wisata Kabupaten Kediri</h1>
        <div class="mt-5 text-left mb-2" style="font-size: 12px">
            <strong>Total Pesan Masuk = {{$pesan->count()}}</strong>
        </div>

        <table class="table table-bordered text-center" style="font-size: 12px">
            <thead>
                <tr>
                    <th class="col-no">No</th>
                    <th>Tanggal</th>
                    <th>Nama wisata</th>
                    <th>Nama Pengunjung</th>
                    <th>Rating</th>
                    <th>Komentar</th>




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

                </tr>
                <?php } ?>


            </tbody>
        </table>

    </div>
    {{-- <strong style="text-align: left !important;margin-top:20px">Total tiket terjual = {{ $transaksi->count() }}
    <strong style="text-align: left !important;margin-top:20px">Total Pengunjung = {{ $transaksi->count() }} --}}

</body>

</html>
