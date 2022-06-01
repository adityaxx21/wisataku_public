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
                    <span><i class="fa fa-star" style="color: orange;"></i> {{ isset($item->rating) ? $item->rating : 5 }}
                        | {{ isset($item->terjual) ? $item->terjual : 0 }} Terjual</span>
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
    <h3 class="text-center mt-5">{{$halaman_pengunjung->judul}}</h3>
    <div class="container mt-4">
        <p class="text-justify">{{$halaman_pengunjung->deskripsi}}</p>
    </div>
@endsection
