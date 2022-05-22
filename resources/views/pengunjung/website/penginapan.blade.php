@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="container mt-5">

        <h3>Halaman Penginapan</h3>
        <div class="row mb-4">
            <div class="col-sm-8"></div>
            <div class="col-sm-4">

                {{-- search --}}
                <form id="submit_form" action="/penginapan" method="POST" onsubmit="myfunction()">
                    @csrf
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" placeholder="Search" name="search">
                    </div>
                </form>


            </div>
        </div>
        <div class="row">
            {{-- item --}}
            @foreach ($penginapan as $key=>$item)
            <div class="col-sm-3 mb-4">
                <div class="card" style="width:100%">
                    <div class="media media-2x1 gd-primary">
                        <img class="image-card" src="{{URL::asset('storage/uploads/Penginapan/hotel.png')}}">
                    </div>
                    <div class="card-body card-popular">
                        <a href="/detailpenginapan/{{$item->nama_penginapan}}"><h5 class="card-title">{{$item->nama_penginapan}}</h5></a>
                        <p><i class="fa fa-map-marker"></i> Kab. Kediri</p>
                    </div>
                </div>
            </div>
            @endforeach
            

        </div>
    </div>
@endsection
