@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="pl-5 mt-5">
        <div class="font-weight-bold">
            <h5>Pencarian : {{ $name }}</h5>
        </div>
    </div>
    <div class="container mt-3">

        @if (!isset($wisata[0]->nama_wisata) && !isset($penginapan[0]->nama_penginapan) && !isset($kategori[0]->nama_wisata))
            <div class="p-3 mb-2 bg-secondary text-white text-center" style="opacity: 0.5">Hasil Pencarian Tidak Ditemukan
            </div>
        @endif

        {{-- Filter Kategori --}}

        {{-- wisata --}}
        @if (isset($wisata[0]->nama_wisata))
            <div class="font-weight-bold mt-4">Hasil Wisata</div>
            <div class="row mt-2">
        @endif

        {{-- item --}}
        @foreach ($wisata as $key => $item)
            <div class="col-sm-3 mb-4">
                <div class="card" style="width:100%">
                    <div class="media media-2x1 gd-primary">
                        <img class="image-card" src="{{ URL::asset($item->gambar) }}">
                    </div>
                    <div class="card-body">
                        <a href="/detail/{{ $item->id }}">
                            <h5 class="card-title">{{ $item->nama_wisata }}</h5>
                        </a>
                        <span><i class="fa fa-star" style="color: orange;"></i> {{ $rating[$key] }} |
                            {{ $jumlah[$key] }} Terjual</span>
                        <p><i class="fa fa-map-marker"></i> Kediri</p>
                    </div>
                </div>
            </div>
        @endforeach

        @if (isset($wisata[0]->nama_wisata))
    </div>
    @endif



    {{-- Penginapan --}}
    @if (isset($penginapan[0]->nama_penginapan))
        <div class="font-weight-bold mt-4">Hasil Penginapan</div>
        <div class="row mt-2">
    @endif
    @foreach ($penginapan as $key => $item)
        {{-- item --}}
        <div class="col-sm-3 mb-4">
            <div class="card" style="width:100%">
                <div class="media media-2x1 gd-primary">
                    <img class="image-card" src="{{ URL::asset($item->gambar) }}">
                </div>
                <div class="card-body card-popular">
                    <a href="/detailpenginapan/{{ $item->nama_penginapan }}" >
                        <h5 class="card-title">{{ $item->nama_penginapan }}</h5>
                    </a>
                    <p><i class="fa fa-map-marker"></i>Kediri</p>
                </div>
            </div>
        </div>
    @endforeach
    @if (isset($penginapan[0]->nama_penginapan))
        </div>
    @endif

    {{-- Kategori --}}
    @if (isset($kategori[0]->nama_wisata))
        <div class="font-weight-bold mt-4">Hasil Kategori Wisata</div>
        <div class="row mt-2">
    @endif
    @foreach ($kategori as $key => $item)
        {{-- item --}}
        <div class="col-sm-3 mb-4">
            <div class="card" style="width:100%">
                <div class="media media-2x1 gd-primary">
                    <img class="image-card" src="{{ URL::asset($item->gambar) }}">
                </div>
                <div class="card-body card-popular">
                    <a href="/kategori/{{ $item->nama_wisata }}">
                        <h5 class="card-title">{{ $item->nama_wisata }}</h5>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    @if (isset($kategori[0]->nama_wisata))
        </div>
    @endif

    </div>
@endsection
