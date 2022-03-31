@extends('layout.index')

@section('container')
    <center>
        {{-- Jumlah akun --}}
        <div class="col-md-3   widget widget_tally_box">
            <div class="x_panel fixed_height_390">
                <div class="x_content">

                    <div class="flex">
                        <ul class="list-inline widget_profile_box">
                            <li>
                                <a>
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <img src="images/user.png" alt="..." class="img-circle profile_img">
                            </li>
                            <li>
                                <a>
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <h3 class="name">Musimbi</h3>

                    <div class="flex">
                        <ul class="list-inline count2">
                            <li>
                                <h3>123</h3>
                                <span>Articles</span>
                            </li>
                            <li>
                                <h3>1234</h3>
                                <span>Followers</span>
                            </li>
                            <li>
                                <h3>123</h3>
                                <span>Following</span>
                            </li>
                        </ul>
                    </div>
                    <p>
                        If you've decided to go in development mode and tweak all of this a bit, there are few things you
                        should do.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3   widget widget_tally_box">
            <div class="x_panel fixed_height_390">
                <div class="x_content">

                    <div class="flex">
                        <ul class="list-inline widget_profile_box">
                            <li>
                                <a>
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <img src="images/user.png" alt="..." class="img-circle profile_img">
                            </li>
                            <li>
                                <a>
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <h3 class="name">Musimbi</h3>

                    <div class="flex">
                        <ul class="list-inline count2">
                            <li>
                                <h3>123</h3>
                                <span>Articles</span>
                            </li>
                            <li>
                                <h3>1234</h3>
                                <span>Followers</span>
                            </li>
                            <li>
                                <h3>123</h3>
                                <span>Following</span>
                            </li>
                        </ul>
                    </div>
                    <p>
                        If you've decided to go in development mode and tweak all of this a bit, there are few things you
                        should do.
                    </p>
                </div>
            </div>
        </div>
        {{-- end jumlah --}}
    </center>
@endsection
