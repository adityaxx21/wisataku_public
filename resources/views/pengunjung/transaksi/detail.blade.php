@extends('pengunjung.layout.homePengunjung')
@section('pengunjung')
    <div class="box pengunjung mb-5">
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Detail <span class="title">Transaksi</span></h3>

                </div>
                <div class="card-box table-responsive">
                    <table id="tabelku" class="table table-striped table-bordered table-detail" style="width:100%">
                        <tbody>
                            {{-- <button onclick="$('#isChange').html('Hello World')"></button> --}}
                            <tr>
                                <td class="col1" id="isChange">No Invoice</td>
                                <td>{{ $transaksi->id_transaksi }}</td>
                            </tr>

                            <tr>
                                <td>Nama</td>
                                <td>{{ $transaksi->uname }}</td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>{{ $transaksi->email }}</td>
                            </tr>

                            <tr>
                                <td>Wisata</td>
                                <td>{{ $transaksi->nama_wisata }}</td>
                            </tr>

                            <tr>
                                <td>Jumlah Orang</td>
                                <td>{{ $transaksi->jumlah_tiket_anak + $transaksi->jumlah_tiket_dewasa }}</td>
                            </tr>

                            <tr>
                                <td>Jumlah Kendaraan</td>
                                <td>{{ $transaksi->jumlah_motor + $transaksi->jumlah_mobil + $transaksi->jumlah_kendaraan_umum }}
                                </td>
                            </tr>

                            <tr>
                                <td>Tanggal Transaksi</td>
                                <td>{{ date('d/m/Y', strtotime($transaksi->tanggal)) }}</td>
                            </tr>

                            

                            <tr>
                                <td>Total Harga</td>
                                <td>Rp. {{ $transaksi->gross_amount }}</td>
                            </tr>

                            <tr>
                                <td>Status</td>
                                <td>
                                    
                                    
                                    @if ($transaksi->status == 'Pending')
                                        <span id="{{ $transaksi->status }}" class="{{ $transaksi->span_class_i }}"><i
                                                class="{{ $transaksi->i_class_i }}"></i>&nbsp;
                                            {{ $transaksi->deskripsi_status }}</span>
                                        <br />
                                        <meta name="viewport" content="width=device-width, initial-scale=1">
                                        <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
                                        <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-uyb5rEus3lvtOYH-"                                                                            "></script>
                                        <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

                                        <button id="pay-button" class="btn btn-primary lihat-tiket mt-3"><span>Lihat Tiket</span></button>
                                        <form id="submit_form" method="POST" hidden>
                                            @csrf
                                            <input type="hidden" name="json" id="json_callback">
                                            <input type="hidden" name="QR_code" id="qr_code">
                                        </form>

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
                                                    url: "{{ url('/pengunjungDashboard/detail') }}",
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
                                        // </script>
                                    @endif
                                    @if ($transaksi->status == 'Sukses')
                                        <span id="{{ $transaksi->status }}" class="{{ $transaksi->span_class_i }}"><i
                                                class="{{ $transaksi->i_class_i }}"></i>&nbsp;
                                            {{ $transaksi->deskripsi_status }}</span>
                                        <br />
                                        <a href="/detailtiket/{{$transaksi->id_transaksi}}" class="btn btn-primary lihat-tiket mt-3"><span>Lihat Tiket</span></a>

                                    @endif
                                </td>
                            </tr>
                            @if (session('alert-success'))
                                <script>
                                    alert("{{ session('alert-success') }}")
                                </script>
                            @elseif(session('alert-failed'))
                                <script>
                                    alert("{{ session('alert-failed') }}")
                                </script>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
