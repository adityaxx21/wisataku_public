@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="container mt-4">
        <div class="text-center mb-5">
            <h2>Form Pesan Tiket</h2>
        </div>
        <div class="x_content">
            <br>
            <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left"
                action="/pesantiket/{{ $wisata->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Jumlah Tiket Dewasa</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="text">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Jumlah Tiket Anak-anak</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="text">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Kendaraan Motor</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Kendaraan Mobil</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Kendaraan Umum</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="text">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Tanggal Datang</label>
                    <div class="col-sm-3">
                        <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="date"
                            required="required" onfocus="this.type='date'" onmouseover="this.type='date'"
                            onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)"
                            name="tgldatang">
                        <script>
                            function timeFunctionLong(input) {
                                setTimeout(function() {
                                    input.type = 'text';
                                }, 60000);
                            }
                        </script>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Catatan</label>
                    <div class="col-sm-5">
                        <textarea id="catatan" required="required" class="form-control" name="catatan"
                            data-parsley-trigger="keyup"></textarea>
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-2 offset-md-4">
                        <button class="btn btn-danger" type="submit"><i class="fa fa-cart-shopping mr-2"></i>Beli
                            Sekarang</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
