@extends('layout.index')

@section('container')
    <div class="box tambahAkun">
        <h3>Edit <span class="title akun">Penginapan</span></h3>
        <form action="/editPenginapan" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-upload">
                <div class="row">
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="nama" class="label-form">Gambar</label>
                        <div class="form-group upfile">
                            <input type="file" id="actual-btn" name="gambar" hidden />
                            <label for="actual-btn" name="gambar">Pilih File</label>
                            <span id="file-chosen">Tidak ada file</span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="namaPenginapan" class="label-form">Nama Penginapan</label>
                        <input type="text" value="{{ $penginapan->nama_penginapan }}" name="namaPenginapan"
                            placeholder="Nama Penginapan" class="form-control" required id="namaWisata">
                    </div>


                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="deskripsi" class="label-form">Deskripsi</label>
                        <div class="x_content">
                            <textarea class="form-control" name="deskrisi" id="descr" rows="5">{{ $penginapan->deskripsi }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="hargaPenginapan" class="label-form">Harga Penginapan</label>
                        <input type="text" value="{{ $penginapan->harga }}" name="hargaPenginapan"
                            placeholder="Harga Tiket Dewasa" class="form-control duacol" required>
                    </div>

                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="alamat" class="label-form">Alamat</label>
                        <textarea class="resizable_textarea form-control" name="alamat"
                            placeholder="Masukkan Alamat">{{ $penginapan->alamat }}</textarea>
                    </div>


                    <div class="col-md-6 col-sm-12  form-group">
                        <label for="lat" class="label-form">Latitude</label>
                        <input type="text" value="{{ $penginapan->lat }}" name="lat" id="lat" placeholder="Latitude"
                            class="form-control duacol" required>
                    </div>
                    <div class="col-md-6 col-sm-12  form-group">
                        <label for="long" class="label-form">Longitude</label>
                        <input type="text" name="long" value="{{ $penginapan->long }}" id="long" placeholder="Longitude"
                            class="form-control duacol" required>
                    </div>

                    <div class="col-md-12 col-sm-12  form-group">
                        <div id='map' style='width: 90%; height: 300px;'></div>
                    </div>

                </div>
            </div>
            <div class="button-form">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"><span> Simpan</span></i></button>
                <button type="button" class="btn btn-warning reset" onclick="document.location.reload(true)"><i
                        class="fa fa-repeat"><span>
                            Reset</span></i></button>
                <a href="/kelolaPenginapan" class="btn btn-danger"><i class="fa fa-close"><span> Kembali</span></i></a>
            </div>

        </form>
    </div>

    <script src="js/formUpload/script.js"></script>
    @push('mapscript')
        <script>
            const defultLoc = [{{ $penginapan->long }}, {{ $penginapan->lat }}]

            // const long = document.getElementById("long")

            mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
            const map = new mapboxgl.Map({
                container: 'map', // container ID
                style: 'mapbox://styles/mapbox/streets-v11', // style URL
                center: defultLoc, // starting position [lng, lat]
                zoom: 11.15 // starting zoom
            });

            map.on('click', (e) => {
                const longitude = e.lngLat.lng
                const latitude = e.lngLat.lat
                const namePlace = e.namePlace
                $('#long').val(longitude);
                $('#lat').val(latitude);
                // document.getElementById("lat").value = latitude;
                // document.getElementById("namaWisata").value = namePlace;
                console.log(namePlace)
            })

            const marker = new mapboxgl.Marker() // Initialize a new marker
                .setLngLat([{{ $penginapan->long }}, {{ $penginapan->lat }}]) // Marker [lng, lat] coordinates
                .addTo(map); // Add the marker to the map

            const geocoder = new MapboxGeocoder({
                // Initialize the geocoder
                accessToken: mapboxgl.accessToken, // Set the access token
                mapboxgl: mapboxgl, // Set the mapbox-gl instance
                marker: false, // Do not use the default marker style
                placeholder: 'Cari Lokasi', // Placeholder text for the search bar
                bbox: [111.8263881097281, -8.006662075638332, 112.267107210108, -
                    7.6287067499314105
                ], // Boundary for Berkeley
                proximity: {
                    longitude: 112.011864,
                    latitude: -7.822840
                }
            });

            // Add the geocoder to the map
            map.addControl(geocoder);

            // After the map style has loaded on the page,
            // add a source layer and default styling for a single point
            map.on('load', () => {
                map.addSource('single-point', {
                    'type': 'geojson',
                    'data': {
                        'type': 'FeatureCollection',
                        'features': []
                    }
                });

                map.addLayer({
                    'id': 'point',
                    'source': 'single-point',
                    'type': 'circle',
                    'paint': {
                        'circle-radius': 10,
                        'circle-color': '#448ee4'
                    }
                });

                // Listen for the `result` event from the Geocoder // `result` event is triggered when a user makes a selection
                //  Add a marker at the result's coordinates
                geocoder.on('result', (event) => {
                    map.getSource('single-point').setData(event.result.geometry);
                });
            });

            $(document).on('submit', '#form-data', function() {
                var editor = CKEDITOR.instances['descr'];
                document.getElementById('descr').value = editor.getData();
            })
        </script>
    @endpush

    <script src="js/adminPage/formUpload/script.js"></script>
@endsection
