<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/css/layout/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="css/operatorPage/style.css">

    <title>{{ $title }}</title>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            {{-- side navbar --}}
            <div class="col-md-3 left_col">
                @include('operatorpage.operator_page.sidebarOperator')
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    {{ session()->get('username') }}
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/logout"><i class="fa fa-sign-out pull-right"></i>
                                        Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="box operator mb-5">

                    <div class="row justify-content-center mt-5">
                        <div class="col-md-5">
                            <div class="card-header bg-transparent mb-0">
                                <h5 class="text-center">
                                    <span class="font-weight-bold text-primary">Scan Qr-Code</span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <video id="preview" width="100%"></video>
                                <div class="form-group">
                                    <form action="" id="submit-form" method="POST">
                                        <div class="alert alert-danger print-error-msg" style="display:none">
                                            <ul></ul>
                                        </div>
                                        @csrf
                                        <input type="hidden" id="status_pem">
                                        <input type="text" class="form-control" name="scanner" id="scanner"
                                            placeholder="ID Ticket" id="qrcode" />
                                        <h5 class="text-center mt-4">Detail Pesanan Tiket Wisata</h5>
                                        <div class="x_content">

                                            <table class="table table-striped"
                                                style="border: 2px solid gray; border-radius:2rem">
                                                <tbody>
                                                    <tr>
                                                        <td>Nama Pemesan</td>
                                                        <td id="namaPemesan"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jumlah Pengunjung</td>
                                                        <td id="jmlPengunjung"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Datang</td>
                                                        <td id="tglDatang"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jumlah Kendaraan</td>
                                                        <td id="jmlKendaraan"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status Pembayaran</td>
                                                        <td id="stsPembayaran"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status Verifikasi</td>
                                                        <td id="stsVerifikasi"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Catatan</td>
                                                        <td id="catatan"></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-form reset-btn">
                        <button type="submit" class="btn btn-success submit"><i class="fa fa-check-circle"><span>
                                    Submit</span></i></button>
                        <button onclick="Location.reload()" class="btn btn-warning reset"><i class="fa fa-repeat"><span>
                                    Reset</span></i></button>
                    </div>
                </div>
                </form>
                @if(session('alert-success'))
                <script>alert("{{session('alert-success')}}")</script>
                @elseif(session('alert-failed'))
                <script>alert("{{session('alert-failed')}}")</script>
                @endif
            </div>
            <!-- /page content -->


        </div>

        <!-- jQuery -->
        <script src="js/layout/jquery.min.js"></script>
        <script src="js/scannerQR/instascan.min.js"></script>
        <script src="js/scannerQR/script.js"></script>


        <!-- Bootstrap -->
        <script src="js/layout/bootstrap.bundle.min.js"></script>


        <!-- Custom Theme Scripts -->
        <script src="js/layout/custom.js"></script>

        <script type="text/javascript">
        
            function get_it(id) {
                $.ajax({
                    type: 'GET',
                    url: "/QrTransaksi/"+id,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $('#namaPemesan').html(data.data.nama_pemesan);
                            $('#jmlPengunjung').html(data.data.jumlah_tiket_dewasa+" Dewasa "+data.data.jumlah_tiket_anak+" Anak ");
                            $('#jmlKendaraan').html("Jumlah Motor : "+data.data.jumlah_motor+" Jumlah Mobil : "+data.data.jumlah_mobil+" Jumlah Kendaraan Umum : "+data.data.jumlah_kendaraan_umum);
                            $('#tglDatang').html(data.date);
                            $('#catatan').html(data.data.catatan);
                            if (data.data.id_status_pemb == 0) {
                                $('#status_pem').val(0);
                                $('#stsPembayaran').html("Terbayarkan");
                            } else {
                                $('#status_pem').val(1);
                                $('#stsPembayaran').html("Belum Dibayar");
                            }
                            if (data.data.is_attend == 1) {
                                $('#stsVerifikasi').html("Belum Verifikasi Di Tempat Wisata");
                            } else {
                                $('#stsVerifikasi').html("Sudah Verifikasi Di Tempat Wisata");
                            }
                            
                            // location.reload();
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            }

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
            let scanner = new Instascan.Scanner({
                video: document.getElementById('preview')
            });
            scanner.addListener('scan', function(content) {
                $('#scanner').val(content);
                // $('#submit-form').submit();
                // $('#stsPembayaran').html(data.nama_pemesan);
                get_it(content);
            });

            Instascan.Camera.getCameras().then(function(camera) {
                if (camera.length > 0) {
                    scanner.start(camera[0]);
                } else {
                    console.log('No cameras found');
                }
            }).catch(function(e) {
                console.log(e)
            });
        </script>


</body>

</html>
