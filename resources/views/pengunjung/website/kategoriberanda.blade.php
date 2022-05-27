@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="container mt-5">


        {{-- Filter Kategori --}}
        <div class="font-weight-bold" style="{{$margin}}">Kategori : Wisata {{$nama}}</div>

        <div class="row mt-4">
           
            {{-- item --}}
            @foreach ($wisata as $key=>$item)
            @if ($item != "")
            <div class="col-sm-3 mb-4">
                <div class="card" style="width:100%">
                    <div class="media media-2x1 gd-primary">
                        <img class="image-card" src="{{URL::asset($item->gambar)}}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="/detail/{{$item->id}}">{{$item->nama_wisata}}</a></h5>
                        <span><i class="fa fa-star" style="color: orange;"></i> {{$rating[$key]}} |{{$jumlah[$key]}} Terjual</span>
                        <p><i class="fa fa-map-marker"></i>Kediri</p>
                    </div>
                </div>
            </div>
            @else
            <div class="font-weight-bold" style="margin-bottom: 32%">Hasil Tidak Ditemukan</div>       
            @endif
            @endforeach




        </div>
    </div>
@endsection
