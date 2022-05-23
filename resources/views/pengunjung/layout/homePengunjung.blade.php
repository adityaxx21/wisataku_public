<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="{{URL::asset('/css/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{URL::asset('/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{URL::asset('/css/layout/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('/css/pengunjung/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/tabelstyle/style.css')}}">

    <title>Halaman {{ $title }}</title>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            {{-- side navbar --}}
            <div class="col-md-3 left_col">
                @include('pengunjung.layout.sidebarPengunjung')
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <a href="/" class="btn btn-info btn-header"><i
                        class="fa fa-arrow-left"><span> Lihat Website</span></i></a>

                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @php
                                       $gambar = session()->get('gambar')
                                    @endphp
                                    
                                    <img src="{{asset("$gambar")}}"
                                        width="25" height="25" class="rounded-circle">
                                    {{session()->get('username')}} </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="/">Halaman Utama</a>
                                    <a class="dropdown-item" href="/logout">Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                @yield('pengunjung')
            </div>
            <!-- /page content -->


        </div>

        <!-- jQuery -->
        <script src="{{URL::asset('/js/layout/jquery.min.js')}}"></script>


        <!-- Bootstrap -->
        <script src="{{URL::asset('/js/layout/bootstrap.bundle.min.js')}}"></script>
        <script src="{{URL::asset('/js/tabelku/jquery.dataTables.js')}}"></script>
        <script src="{{URL::asset('/js/tabelku/dataTables.bootstrap.min.js')}}"></script>
        @stack('datatable')
        @stack('button_input')

</body>

</html>
