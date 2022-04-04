<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/css/layout/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="css/adminPage/dashboard/style.css">
    <link rel="stylesheet" href="css/adminPage/kelolaakun/style.css">
    <link rel="stylesheet" href="css/adminPage/kelolaWisata/style.css">
    <link rel="stylesheet" href="css/adminPage/kelolaWisata/dataTables.bootstrap.min.css">

    <title>Halaman {{ $title }}</title>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
          {{-- side navbar --}}
        <div class="col-md-3 left_col">
            @include('layout.sideNavbar')
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <button type="button" class="btn btn-info btn-header" style="display: {{ $title =="Dashboard" ? "none" : "inline-block"}}"><i class="fa fa-arrow-left"><span> Lihat Website</span></i></button>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      nama user
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="javascript:;"> Profile</a>
                        <a class="dropdown-item"  href="javascript:;">
                          <span class="badge bg-red pull-right">50%</span>
                          <span>Settings</span>
                        </a>
                    <a class="dropdown-item"  href="javascript:;">Halp</a>
                      <a class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('container')
        </div>
        <!-- /page content -->

     
    </div>

  <!-- jQuery -->
  <script src="js/layout/jquery.min.js"></script>
  <!-- Bootstrap -->
 <script src="js/layout/bootstrap.bundle.min.js"></script>

  
  <!-- Custom Theme Scripts -->
  <script src="js/layout/custom.js"></script>
  <script src="/js/adminPage/kelolaWisata/jquery.dataTables.js"></script>
  <script src="/js/adminPage/kelolaWisata/dataTables.bootstrap.min.js"></script>
  <script src="js/adminPage/formUpload/bootstrap-wysiwyg.min.js"></script>
  <script src="js/adminPage/formUpload/jquery.hotkeys.js"></script>
  <script src="js/adminPage/formUpload/prettify.js"></script>

  </body>
</html>