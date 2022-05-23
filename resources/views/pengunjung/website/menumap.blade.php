@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="container">
        <div class="card-detail mt-3">
            <div class="mb-4">
                <span class="mt-2 mb-4 font-weight-bold"><i class="fa fa-map"></i> Persebaran Wisata</span>
                <a href="/" class="btn" style="float: right;background-color:#673AB7;color:white" type="button"><i
                        class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
            </div>
            <div id='map_wisata' style='width: 100%; height: 600px;'></div>
        </div>
    </div>
    <script type="text/javascript">
        var lat_long = [];
        var title = [];
        var desk = [];
    </script>
    @foreach ($wisata as $key => $item)
        <script>
            lat_long[{{ $key }}] = ['{{ $item->long }}', '{{ $item->lat }}']
            title[{{ $key }}] = '{{ $item->nama_wisata }}'
            desk[{{ $key }}] = '{{ $item->alamat }}'
        </script>
    @endforeach

    @push('direction')
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
            // Map peresebaran wisata
            mapboxgl.accessToken =
                "pk.eyJ1IjoiYWZmYW5kMDgiLCJhIjoiY2wxc2xweDJlMHhsNzNmbzNjbHh4b2x1ZiJ9.0QmipmGiXP91O01rclSKNw";
            const map = new mapboxgl.Map({
                container: "map_wisata",
                // scrollZoom: false,
                style: "mapbox://styles/mapbox/streets-v11",
                center: [112.011864, -7.822840],
                zoom: 10,
            });

            // data wisata
            const geojson = v;

            for (const feature of geojson) {

                new mapboxgl.Marker({
                        color: "Blue",
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
        </script>
    @endpush
@endsection
