@extends('pengunjung.website.layoutWebsite')
@section('content')
    {{-- full screen slider --}}

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($slider as $key => $item)
                @if ($key == 0)
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ $item->gambar }}">
                    </div>
                @else
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ $item->gambar }}">
                    </div>
                @endif
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <hr />

    {{-- slider wisata populer --}}
    <h3 class="text-center mt-5">Wisata Terpopuler Kami</h3>
    <div class="items mt-4">
        @foreach ($wisata as $key => $item)
            <div class="card">
                <div class="media media-2x1 gd-primary">
                    <img class="image-card" src="{{ $item->gambar }}">
                </div>
                <div class="card-body">
                    <a href="/detail/{{$item->id}}">
                        <h5 class="card-title">{{ $item->nama_wisata }}</h5>
                    </a>
                    <span><i class="fa fa-star" style="color: orange;"></i> {{ isset($rating[$key]) ? $rating[$key] : 5 }}
                        | {{ isset($jumlah[$key]) ? $jumlah[$key] : 0 }} Terjual</span>
                    <p><i class="fa fa-map-marker"></i> Kediri</p>
                </div>
            </div>
        @endforeach


    </div>
    {{-- end slider --}}


    {{-- Kategori Wisata --}}
    <div class="bg-popular">
        <div class="bg-cover">
            <h2 class="text-center font-weight-bold pt-5">Kategori Wisata</h2>
            <div class="container mt-5">
                <div class="row">
                    @foreach ($kategori as $item)
                        <div class="col-sm-3 mb-4">
                            <div class="card " style="width: 15rem;">
                                <img class="image-card" src="{{ $item->gambar }}" alt="Card image cap">
                                <div class="card-body category">
                                    
                                    <a href="/kategori/{{ $item->nama_wisata }}" >
                                        <p class="card-text text-center font-weight-bold">Wisata {{ $item->nama_wisata }}
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    <hr />

    <script>
        $('#qrcode').empty();

        // Set Size to Match User Input
        $('#qrcode').css({
            'width': $('.qr-size').val(),
            'height': $('.qr-size').val()
        })

        // Generate and Output QR Code
        $('#qrcode').qrcode({
            width: $('.qr-size').val(128),
            height: $('.qr-size').val(128),
            text: $('.qr-url').val('10001')
        });
    </script>
    {{-- Informasil Website --}}
    <h3 class="text-center mt-5">Informasi Website</h3>
    <div class="container mt-4">
        <p class="text-justify">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestias autem
            assumenda iure tempore omnis, cupiditate excepturi fuga possimus, quibusdam officia soluta accusamus
            placeat minus exercitationem doloremque, amet a quidem? Eius velit expedita non incidunt ducimus,
            laudantium odio, possimus, consequuntur recusandae officiis in iusto cumque? Necessitatibus sed dolorum
            error eligendi praesentium ex deleniti aliquam consectetur ipsa quibusdam inventore, aspernatur, quis
            nulla minus neque animi eius. Ipsa tenetur inventore corporis maiores facilis odio a qui dolorem eum
            assumenda veniam possimus praesentium eaque veritatis ducimus eveniet harum reprehenderit sequi iusto
            maxime suscipit, fugit similique, molestiae deleniti! Ea illo eos laboriosam nihil deleniti vitae minima
            impedit tempore atque vel blanditiis voluptate sequi repudiandae quis, unde vero culpa minus recusandae
            eius, voluptatibus praesentium quo? Sapiente nam rerum, reiciendis tempore animi expedita quo amet
            perferendis iusto eaque quasi numquam, explicabo exercitationem. Voluptates velit, fugiat dolorum facere
            libero eligendi quo sequi odio quisquam mollitia rem placeat a facilis. Dolorum ex ullam optio fuga
            facilis maxime at debitis, modi voluptate adipisci placeat alias ea, nihil iure itaque expedita eaque
            hic illum excepturi quibusdam eum delectus reiciendis rem! Totam sunt laborum non, architecto tempora,
            officiis exercitationem molestias fugit et optio, veritatis esse facilis mollitia dolor eius perferendis
            quas ratione.</p>
    </div>
@endsection
