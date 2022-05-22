@extends('pengunjung.website.layoutWebsite')
@section('content')
    <div class="container">
        <div class="card-detail mt-3">
            <div class="mb-4">
                <span class="mt-2 mb-4 font-weight-bold"><i class="fa fa-map"></i> Mencari rute dari lokasi anda</span>
                <a href="javascript:history.back()" class="btn" style="float: right;background-color:#673AB7;color:white"
                    type="button"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
            </div>
            <div id='direction' style='width: 100%; height: 600px;'></div>
        </div>
    </div>

    @push('direction')
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
        <link rel="stylesheet"
            href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
            type="text/css">
        <script>
            mapboxgl.accessToken =
                "pk.eyJ1IjoiYWZmYW5kMDgiLCJhIjoiY2wxc2xweDJlMHhsNzNmbzNjbHh4b2x1ZiJ9.0QmipmGiXP91O01rclSKNw";

            var lat;
            var long;

            var destinasi_wisata = [{{$wisata->long}}, {{$wisata->lat}}]

            const geolocate = new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true,
                },
                trackUserLocation: true,
                showUserHeading: true,
            });

            const map = new mapboxgl.Map({
                container: "direction",
                // scrollZoom: false,
                style: "mapbox://styles/mapbox/streets-v11",
                center: destinasi_wisata,
                // zoom:10,
                maxZoom: 15,
                minZoom: 9,
            });

            var directions = new MapboxDirections({
                accessToken: mapboxgl.accessToken,
                interactive: false,
                unit: "metric",

                controls: {
                    inputs: false,
                    instructions: true,
                },
            });

            map.addControl(directions, "bottom-right");

            map.on("load", function() {
                // get current position user
                navigator.geolocation.getCurrentPosition((position) => {
                    directions.setOrigin([
                        position.coords.longitude,
                        position.coords.latitude,
                    ]);
                });

                // direction => ubah coord. sesuai destinasi wisata
                directions.setDestination(destinasi_wisata);
            });
        </script>
    @endpush
@endsection
