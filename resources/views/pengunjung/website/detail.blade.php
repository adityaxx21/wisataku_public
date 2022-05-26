@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="container-detail mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card-detail">
                    <h3>{{ $wisata->nama_wisata }}</h3>
                    <span><i class="fa fa-star" style="color: orange;"></i>
                        {{ isset($rating) ? $rating : 5 }}
                        | {{ isset($jumlah) ? $jumlah : 0 }} Terjual</span>
                    <img src="{{URL::asset($wisata->gambar)}}" alt="" srcset="" class="mt-4">

                    <span class="mt-4 font-weight-bold">Deskripsi :</span>
                    <p style="font-size: .8rem" class="mt-1">{{ $wisata->deskripsi }}</p>

                    <span class="mt-4 mb-4 font-weight-bold"><i class="fa fa-suitcase"></i> Fasilitas :</span>

                    <div class="cards">
                        @foreach ($fasilitas as $key => $item)
                            @foreach ($setel_fasilitas as $key => $item1)
                                @if ($item1->id_fasilitas == $item->id_fasilitas)
                                    <div class="card-fasilitas">
                                        <img src="{{ URL::asset($item->gambar) }}" alt="" height="50">
                                        <br>
                                        <label style="font-size: .8rem">{{$item->nama_fasilitas}}</label>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                        {{-- item fasilitas --}}
            
                    </div>
                    <span class="mt-4 mb-2 font-weight-bold"><i class="fa-solid fa-circle-play mr-2"></i>Lihat 360 :</span>
                    @foreach ($gambar360 as $item)
                    <a href="{{$item->url_360}}" target="_blank"><img src="{{URL::asset($item->gambar)}}" height="100" alt=""></a>
                    @endforeach
                    

                    <span class="mt-4 mb-2 font-weight-bold"><i class="fa fa-bed"></i> Penginapan Terdekat :</span>
                    <span>Keterangan :</span>
                    <div class="mb-2 mt-1">
                        <span class="mr-3"><i class="fa fa-map-marker" style="color: blue"></i> Lokasi Wisata
                        </span>
                        <span><i class="fa fa-map-marker" style="color: red"></i> Penginapan </span>
                    </div>
                    <div id='map_penginapan' style='width: 100%; height: 300px;'></div>

                    <span class="mt-4 mb-2 font-weight-bold"><i class="fa fa-comment"></i> Ulasan Pengunjung ({{$jumlah}})</span>
                    {{-- item comment --}}
                    @foreach ($komentar as $key=>$item)
                    
                        @if ($item->pesan != "")
                        <div class="card comment mb-3">
                        <span class="font-weight-bold">{{$item->username}}</span>
                        <div class="rating-css">
                            @for ($i = 0; $i < $item->rating; $i++)
                            <label for="rating" class="fa fa-star"></label>
                            @endfor
                           
                        </div>
                        <p style="font-size: .8rem">{{$item->pesan}}</p>
                        @if ($item->pesan_balas != "")
                        <div class="balasan">
                            <span class="font-weight-bold" style="font-size: .8rem"> Admin</span>
                            <p style="font-size: .7rem">{{$item->pesan_balas}}</p>
                        </div> 
                        @endif
                    </div>
                        @endif
                      
                    @endforeach

                </div>
            </div>
            <div class="col-md-6">
                <div class="card-detail">
                    <span class="mt-2 mb-4 font-weight-bold"><i class="fa fa-map"></i> Maps :</span>

                    <div id='map_rute' style='width: 100%; height: 300px;'></div>

                    <a href="/carirute/{{$wisata->id}}" class="btn btn-primary btn-sm mt-3"><i
                            class="fa-solid fa-location-arrow mr-2"></i>Cari
                        Rute</a>

                    <div class="detail_wisata mt-4">
                        {{-- item keterangan --}}
                        <article class="media event mt-2" style="align-items: center">
                            <a class="pull-left date mr-3">
                                <span class="fa-stack" style="vertical-align: middle;">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-location-dot fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <div class="media-body mt-0">
                                <strong>Alamat</strong>
                                <p style="font-size: .9rem;margin-bottom:0px">{{$wisata->alamat}}</p>

                            </div>
                        </article>

                        {{-- item keterangan --}}
                        <article class="media event mt-2" style="align-items: center">
                            <a class="pull-left date mr-3">
                                <span class="fa-stack" style="vertical-align: middle;">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-clock fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <div class="media-body">
                                <strong>Jam Operasional</strong>
                                <p style="font-size: .9em;margin-bottom:0px">10.00 Am - 17.00 pm</p>

                            </div>
                        </article>

                        {{-- item keterangan --}}
                        <article class="media event mt-2" style="align-items: center">
                            <a class="pull-left date mr-3">
                                <span class="fa-stack" style="vertical-align: middle;">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-ticket fa-stack-1x fa-inverse fa-rotate-by"
                                        style="--fa-rotate-angle: -45deg;"></i>
                                </span>
                            </a>
                            <div class="media-body">
                                <strong>Harga Tiket Dewasa</strong>
                                <p style="font-size: .9em;margin-bottom:0px">Rp. {{$wisata->tiketDewasa}},-</p>

                            </div>
                        </article>

                        {{-- item keterangan --}}
                        <article class="media event mt-2" style="align-items: center">
                            <a class="pull-left date mr-3">
                                <span class="fa-stack" style="vertical-align: middle;">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-ticket fa-stack-1x fa-inverse fa-rotate-by"
                                        style="--fa-rotate-angle: -45deg;"></i>
                                </span>
                            </a>
                            <div class="media-body">
                                <strong>Harga Tiket Anak-anak</strong>
                                <p style="font-size: .9em;margin-bottom:0px">Rp. {{$wisata->tiketAnak}},-</p>

                            </div>
                        </article>

                        {{-- item keterangan --}}
                        <article class="media event mt-2" style="align-items: center">
                            <a class="pull-left date mr-3">
                                <span class="fa-stack" style="vertical-align: middle;">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-motorcycle fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <div class="media-body">
                                <strong>Parkir Motor</strong>
                                <p style="font-size: .9em;margin-bottom:0px">Rp. {{$wisata->parkirmotor}},-</p>

                            </div>
                        </article>

                        {{-- item keterangan --}}
                        <article class="media event mt-2" style="align-items: center">
                            <a class="pull-left date mr-3">
                                <span class="fa-stack" style="vertical-align: middle;">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-car fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <div class="media-body">
                                <strong>Parkir Mobil</strong>
                                <p style="font-size: .9em;margin-bottom:0px">Rp. {{$wisata->parkirmobil}},-</p>

                            </div>
                        </article>

                        {{-- item keterangan --}}
                        <article class="media event mt-2" style="align-items: center">
                            <a class="pull-left date mr-3">
                                <span class="fa-stack" style="vertical-align: middle;">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-bus fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <div class="media-body">
                                <strong>Parkir Umum</strong>
                                <p style="font-size: .9em;margin-bottom:0px">Rp. {{$wisata->parkirumum}},-</p>

                            </div>
                        </article>


                    </div>


                    <a href="/pesantiket/{{$wisata->id}}" class="btn btn-danger btn-sm mt-3 font-weight-bold">Beli Tiket Sekarang !</a>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var lat_long = [];
        var title = [];
        var desk = [];
    </script>
    @foreach ($penginapan as $key => $item)
        <script>
            lat_long[{{$key}}] = ['{{$item->long}}', '{{$item->lat}}']
            title[{{$key}}] = '{{$item->nama_penginapan}}'
            desk[{{$key}}] = '{{$item->alamat}}'
        </script>
    @endforeach

    @push('map')
        <script>
            const v = [];
            for (let i = 0; i < desk.length; i++) {
                 v[i] = {
                    geometry: {
                        type: "Point",
                        coordinates: lat_long[i],
                    },
                    properties: {
                        title: title[i],
                        description: desk[i],
                    },
                }
                
            }
            
            // Map Penginapan terdekat
            mapboxgl.accessToken =
                "pk.eyJ1IjoiYWZmYW5kMDgiLCJhIjoiY2wxc2xweDJlMHhsNzNmbzNjbHh4b2x1ZiJ9.0QmipmGiXP91O01rclSKNw";
            const map = new mapboxgl.Map({
                container: "map_penginapan",
                scrollZoom: false,
                style: "mapbox://styles/mapbox/streets-v11",
                center: [{{$wisata->long}}, {{$wisata->lat}}],
                zoom: 10,
            });

            // marker titik pusat wisata (contoh di bawah adalah Gunung Kelud)
            const marker1 = new mapboxgl.Marker({
                    color: "Blue",
                })
                .setLngLat([{{$wisata->long}}, {{$wisata->lat}}])

                .addTo(map);

            const geojson = v;

            // const geojson = geoSons;
            for (const feature of geojson) {

                new mapboxgl.Marker({
                        color: "red",
                    })
                    .setLngLat(feature.geometry.coordinates)
                    .setPopup(
                        new mapboxgl.Popup({
                            offset: 25,
                        }) // add popups
                        .setHTML(
                            `<h6 class="mt-0">${feature.properties.title}</h6><div class="hr"><spa>${feature.properties.description}</spa>`
                        )
                    )
                    .addTo(map);
            }

            // end map penginapan terdekat

            // map rute wisata
            const rute = new mapboxgl.Map({
                container: "map_rute",
                style: "mapbox://styles/mapbox/streets-v11",
                scrollZoom: false,
                interactive: false,
                center: [{{$wisata->long}}, {{$wisata->lat}}],
                zoom: 11,
            });

            const marker_wisata = new mapboxgl.Marker({
                    color: "Blue",
                })
                .setLngLat([{{$wisata->long}}, {{$wisata->lat}}])
                .setPopup(
                    new mapboxgl.Popup({
                        offset: 25,
                        close: false,
                        closeButton: false,
                    }) // add popups
                    .setHTML(
                        `<h6 class="mt-0">{{$wisata->nama_wisata}}</h6><div class="hr"><spa>{{$wisata->alamat}}</spa>`
                    )
                )
                .addTo(rute)
                .togglePopup();




            // end map rute wisata
        </script>
    @endpush
@endsection
