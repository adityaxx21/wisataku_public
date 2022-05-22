@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="text-center mb-5 mt-5">
        <h2>Hubungi Kami</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 form-group">
                <input type="text" placeholder="Nama" class="form-control contact mb-3" name="nama">
                <input type="text" placeholder="Email" class="form-control contact mb-3" name="email">
                <input type="text" placeholder="No. Telepon" class="form-control contact mb-3" name="telp">

                <textarea id="message" placeholder="Komentar anda" required="required" class="form-control mt-2"name="comment"></textarea>

                <a href="/detailpesanan" class="btn btn-success mt-3" type="button"><i
                        class="fa fa-paper-plane mr-2"></i>Kirim</a>
            </div>
            <div class="col-md-6 col-sm-12  form-group">
                <h6 class="text-uppercase font-weight-bold mb-2">
                    Wisata Kediriku
                </h6>

                <p style="font-size: .8rem">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore corrupti officiis suscipit laudantium
                    sit qui nostrum repellat dolore commodi! Delectus, corrupti? Provident illo inventore facere rem itaque
                    alias iusto neque aspernatur, atque pariatur modi debitis, assumenda nihil? Error, maxime. Ab rerum
                    fugit voluptates quod. Veritatis esse inventore minus molestiae repellat!
                </p>
            </div>
        </div>
    </div>
@endsection
