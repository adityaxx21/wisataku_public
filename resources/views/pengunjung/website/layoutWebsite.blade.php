<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Including the bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css"
        integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous">


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <link href="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.js"></script>



    <link rel="stylesheet" href="{{ URL::asset('css/website/style.css') }}">
    <title>{{ $title }}</title>
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-light bg-light">

        <a href="/"><span class="navbar-brand mb-0 h1">Wisata <span class="top-title">Kabupaten
                    Kediri</span></span></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="search-form">
                        <form action="/search" method="POST">
                            @csrf
                            <input type="search" name="search-box" placeholder="search here..." id="search-box"
                                class="search">
                            <i for="search-box" class="fa fa-search icon-search"></i>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Beranda' ? 'active' : '' }}" href="/">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Halaman Wisata' ? 'active' : '' }}" href="/wisata">
                        Wisata</a>
                </li>
                <li class="nav-item">
                    <a href="/penginapan" class="nav-link  {{ $title == 'Penginapan' ? 'active' : '' }}"
                        href="/penginapan">
                        Penginapan</a>
                </li>
                <li class="nav-item">
                    <a href="/map" class="nav-link {{ $title == 'Map' ? 'active' : '' }}" href="/map">
                        Map</a>
                </li>
                <li class="nav-item">
                    <a href="/hubungikami" class="nav-link  {{ $title == 'Hubungi Kami' ? 'active' : '' }}"
                        href="/hubungikami">
                        Hubungi Kami</a>
                </li>
                @if (session()->get('username') == null)
                    <li class="nav-item">
                        <a href="/login" class="nav-link  {{ $title == 'Login' ? 'active' : '' }}" href="/login">
                            Login</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ URL::asset(session()->get('gambar')) }}" width="25" height="25"
                                class="rounded-circle">
                            {{ session()->get('username') }} </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @if (session()->get('hak_akses') == 0)
                                <a class="dropdown-item" href="/DasboardAdmin">Dashboard</a>
                            @elseif (session()->get('hak_akses') == 1)
                                <a class="dropdown-item" href="/QrTransaksi">Dashboard</a>
                            @else
                                <a class="dropdown-item" href="/pengunjungDashboard/transaksi">Dashboard</a>
                            @endif

                            <a class="dropdown-item" href="/logout">Log Out</a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>


    {{-- content --}}
    @yield('content')
    {{-- end content --}}

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted mt-5 bg-footer text-footer">
        <div class="bg-cover">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom sosmed">
                <!-- Left -->
                <div class="me-5 d-none d-lg-block sosmed">
                    <span>Our Social Media :</span>
                </div>
                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="" class="me-4 text-reset mr-2">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="" class="me-4 text-reset mr-2">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="" class="me-4 text-reset mr-2">
                        <i class="fa-brands fa-google"></i>
                    </a>
                    <a href="" class="me-4 text-reset mr-2">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fa fa-gem me-3"></i>Wisata Kediriku
                            </h6>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi aut praesentium incidunt
                                optio
                                accusantium illum aliquid tempore nulla enim cum!
                            </p>
                        </div>
                        <!-- Grid column -->





                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Contact
                            </h6>
                            <p><i class="fa fa-home me-3"></i>Kediri Bersemi</p>
                            <p>
                                <i class="fa fa-envelope me-3"></i>
                                wisatakediri@example.com
                            </p>
                            <p><i class="fa fa-phone me-3"></i> + 01 234 567 88</p>
                            <p><i class="fa fa-print me-3"></i> + 01 234 567 89</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2022 Copyright:
                <a class="text-reset fw-bold" href="#">wisatakediri.com</a>
            </div>
            <!-- Copyright -->
        </div>
    </footer>
    <!-- Footer -->
    <script>
        function findme() {
            $.ajax({
                type: 'POST',
                url: '/search',
                data: {
                    input: $('#search-box').val(),
                },
                success: function(data) {}
            });
        }
    </script>
</body>
<script src="{{ URL::asset('js/website/script.js') }}"></script>
@stack('map')
@stack('direction')
@stack('qrcode-generator')

</html>
