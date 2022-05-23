@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-sm-8">
                {{-- Filter Kategori --}}
                <form action="/wisata" method="GET" id="submit">
                    @csrf
                    Kategori : <select id="kategoriWisata" name="kategoriWisata" class="myform ml-1 mr-5" required="" onchange="submit(submit)">
                        <option value=""></option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" {{ request('kategoriWisata') === $item->id ? 'selected' : null }}>
                                Wisata {{ $item->nama_wisata }}</option>
                        @endforeach
                    </select>
    
                    {{-- Filter Harga --}}
                    Harga : <select id="kategoriHarga" name="kategoriHarga" class="myform myform ml-1 mr-5" required="">
                        <option value=""></option>
                        <option value="murah">0 - 10.000</option>
                        <option value="sedang">10.000 - 50.000</option>
                        <option value="mahal">60.000 - 100.000</option>
                        
                    </select>
                </div>
                <div class="col-sm-4">
    
                    {{-- search --}}
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" placeholder="Search" name="search">
                    </div>
    
                </div>
                </form>
 
        </div>
        <div class="row">
            {{-- item --}}

            @foreach ($wisata as $key => $item)
                <div class="col-sm-3 mb-4">
                    <div class="card" style="width:100%">
                        <div class="media media-2x1 gd-primary">
                            <img class="image-card" src="{{ URL::asset($item->gambar) }}">
                        </div>
                        <div class="card-body card-popular">
                            <a href="/detail/{{ $item->id }}">
                                <h5 class="card-title">{{ $item->nama_wisata }}</h5>
                            </a>
                            <span><i class="fa fa-star" style="color: orange;"></i>
                                {{ isset($rating[$key]) ? $rating[$key] : 5 }}
                                | {{ isset($jumlah[$key]) ? $jumlah[$key] : 0 }} Terjual</span>
                            <p><i class="fa fa-map-marker"></i> Kediri </p>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>
    </div>
@endsection
