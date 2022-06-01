@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-sm-8">
                {{-- Filter Kategori --}}
                <form action="/wisata" method="GET" id="submit">
                    @csrf
                    Kategori : <select id="kategoriWisata" name="kategoriWisata" class="myform ml-1 mr-5">
                        <option value=""></option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id_wisata }}" {{ $id_wis == $item->id_wisata ? 'selected' : null }}>
                                Wisata {{ $item->nama_wisata }} </option>
                        @endforeach
                    </select>
    
                    {{-- Filter Harga --}}
                    Harga : <select id="kategoriHarga" name="kategoriHarga" class="myform myform ml-1 mr-5" > 
                        <option value=""></option>
                        @foreach ($range as $item)
                        <option value="{{ $item->label }}" {{ $range_harga == $item->label ? 'selected' : null }}>
                            {{$item->harga_min}} - {{$item->harga_max}}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="col-sm-3">
    
                    {{-- search --}}
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" placeholder="Search" name="search" value="{{isset($nama_wisata) ? $nama_wisata : null}}">
                    </div>
    
                </div>
                <div class="col-sm-1">
    
                    {{-- search --}}
                    <button type="submit"><i class="bi bi-search">Search</i></button>
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
                                {{ isset($item->rating) ? $item->rating : 0 }}
                                | {{ isset($item->terjual) ? $item->terjual : 0 }} Terjual</span>
                            <p><i class="fa fa-map-marker"></i> Kediri </p>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>
    </div>
@endsection
