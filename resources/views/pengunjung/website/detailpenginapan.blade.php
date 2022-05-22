@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="container-detail mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card-detail">
                    <h3>{{$penginapan->nama_penginapan}}</h3>
                   
                    <img src="{{URL::asset($penginapan->gambar)}}" alt="" srcset="" class="mt-4">

                    <span class="mt-4 font-weight-bold">Deskripsi :</span>
                    <p style="font-size: .8rem" class="mt-1">{{$penginapan->deskripsi}}</p>

                   


                </div>
            </div>
            <div class="col-md-6">
                <div class="card-detail">
                    <span class="mt-2 mb-4 font-weight-bold"><i class="fa fa-map"></i> Maps :</span>

                    <div id='map_rute' style='width: 100%; height: 300px;'></div>


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
                                <p style="font-size: .9rem;margin-bottom:0px">{{$penginapan->alamat}}</p>

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
                                    <i class="fa fa-ticket fa-stack-1x fa-inverse fa-rotate-by" style="--fa-rotate-angle: -45deg;"></i>
                                </span>
                            </a>
                            <div class="media-body">
                                <strong>Harga</strong>
                                <p style="font-size: .9em;margin-bottom:0px">Rp. {{$penginapan->harga}}</p>

                            </div>
                        </article>
                     
                        
                     
                    </div>


                  

                </div>
            </div>
        </div>
    </div>

    @push('map')
        <script>// map rute wisata
        mapboxgl.accessToken =
    "pk.eyJ1IjoiYWZmYW5kMDgiLCJhIjoiY2wxc2xweDJlMHhsNzNmbzNjbHh4b2x1ZiJ9.0QmipmGiXP91O01rclSKNw";
            const rute = new mapboxgl.Map({
                container: "map_rute",
                style: "mapbox://styles/mapbox/streets-v11",
                scrollZoom: false,
                interactive: false,
                center: [{{$penginapan->long}}, {{$penginapan->lat}}],
                zoom: 11,
            });
            
            const marker_wisata = new mapboxgl.Marker({
                color: "Blue",
            })
                .setLngLat([{{$penginapan->long}}, {{$penginapan->lat}}])
                .setPopup(
                    new mapboxgl.Popup({
                        offset: 25,
                        close:false,
                        closeButton:false,
                    }) // add popups
                        .setHTML(
                            `<h6 class="mt-0">{{$penginapan->nama_penginapan}}</h6><div class="hr"><spa>Kediri</spa>`
                        )
                )
                .addTo(rute)
                .togglePopup();
            
            </script>
    @endpush
@endsection
