@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Detail <span class="title">Pesanan</span></h3>

                </div>
                <div class="card-box table-responsive mt-4">
                    <table id="tabelku" class="table table-striped table-bordered table-detail" style="width:100%">
                        <tbody>
                            <tr>
                                <td class="col1">No Invoice</td>
                                <td>{{$no_invoice}}</td>
                            </tr>

                            <tr>
                                <td>Nama Pemesan</td>
                                <td>{{$transaksi->uname}}</td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>{{$transaksi->email}}</td>
                            </tr>

                            <tr>
                                <td>Alamat</td>
                                <td>{{$transaksi->alamat}}</td>
                            </tr>

                            <tr>
                                <td>Nama Wisata</td>
                                <td>{{$transaksi->nama_wisata}}</td>
                            </tr>

                            <tr>
                                <td>Tiket Dewasa</td>
                                <td>{{$transaksi->jumlah_tiket_dewasa}}</td>
                            </tr>

                            <tr>
                                <td>Tiket Anaak-anak</td>
                                <td>{{$transaksi->jumlah_tiket_anak}}</td>
                            </tr>

                            <tr>
                                <td>Motor</td>
                                <td>{{$transaksi->jumlah_motor}}</td>
                            </tr>

                            <tr>
                                <td>Mobil</td>
                                <td>{{$transaksi->jumlah_mobil}}</td>
                            </tr>

                            <tr>
                                <td>Umum</td>
                                <td>{{$transaksi->jumlah_kendaraan_umum}}</td>
                            </tr>

                            <tr>
                                <td>Tanggal Masuk</td>
                                <td>{{ date("d/m/Y", strtotime($transaksi->tanggal_kedatangan))}}</td>
                            </tr>

                            <tr>
                                <td>Total Pesanan</td>
                                <td>Rp. {{$transaksi->gross_amount}}</td>
                            </tr>
                            
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                        <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
                        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
                                                data-client-key="SB-Mid-client-p3ZANgkDvn4BQswk"></script>
                        <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

                            
                        <form id="submit_form" method="POST" hidden>
                            @csrf
                            <input type="hidden" name="json" id="json_callback">
                            <input type="hidden" name="QR_code" id="qr_code">

                        </form>

                        
                            
                        </tbody>
                    </table>
                    {{-- <button  class="btn btn-primary lihat-tiket mt-3"><span>Lihat
                        Tiket</span></button> --}}
                    <center><button id="pay-button" class="btn btn-danger lihat-tiket mt-3"><i class="fa-solid fa-money-bill mr-2"></i><span>Bayar Sekarang</span></button></center>
                    <script type="text/javascript">
                        // For example trigger on button clicked, or any time you need
                        var payButton = document.getElementById('pay-button');
                        payButton.addEventListener('click', function() {
                            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                            window.snap.pay('{{ $snapToken }}', {
                                onSuccess: function(result) {
                                    /* You may add your own implementation here */
                                    console.log(result);
                                    // alert(result);
                                    send_response_to_form(result);
                                },
                                onPending: function(result) {
                                    /* You may add your own implementation here */
                                    console.log(result);
                                    send_response_to_form(result);
                                },
                                onError: function(result) {
                                    /* You may add your own implementation here */
                                    console.log(result);
                                    send_response_to_form(result);
                                },
                                onClose: function() {
                                    /* You may add your own implementation here */
                                    alert('you closed the popup without finishing the payment');
                                }
                            })
                        });

                        function send_response_to_form(result) {
                            document.getElementById('json_callback').value = JSON.stringify(result);
                            // document.getElementById('qr_code').value = $('.qr').attr();
                            // alert($('#qr_code').val());

                            $('#submit_form').submit();
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('/detailpesanan/asdasd') }}",
                                data: {
                                    json: JSON.stringify(result),
                                },
                                success: function(data) {
                                    if ($.isEmptyObject(data.error)) {
                                        // alert(data.alert-success);
                                        // location.reload();
                                    } else {
                                        printErrorMsg(data.error);
                                    }
                                    $('#isChange').html('Hello World');
                                }
                            });
                        }
                        //
                    </script>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
