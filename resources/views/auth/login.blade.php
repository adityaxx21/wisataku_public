<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css"
        integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login/style.css">
    <title>Halaman Login</title>
</head>

<body>
    <div class="kotakTengah">
        <ul class="box-wrapped">
            <li class="li1">
                <img src="image/login/logokab.png" alt="">
            </li>
            <li class="li2">
                <h3>Masuk</h3>
                <form class="myForm" method="POST" action="/login">
                    @csrf
                    <label for="username">Username </label>
                    <div class="input-form">
                        <i class="fa fa-envelope icon"></i>
                        <input type="text" name="username" id="username" required>
                    </div>

                    <label for="email_address">Password </label>
                    <div class="input-form">
                        <i class="fa fa-unlock-alt icon"></i>
                        <input type="password" name="password" id="password">
                    </div>

                    @if (Session::has('message'))
                        <span class="alert"><i class="fa-solid fa-circle-exclamation"></i>
                            {{ Session::get('message') }}</span>
                    @endif

                    <button>Masuk</button>
                </form>
                <span>Belum punya akun? <a href="/signup">Daftar</a></span>
            </li>

        </ul>

        @if (session('alert-notif'))
            <script>
                alert("{{ session('alert-notif') }}")
            </script>
        @endif
    </div>

</body>

</html>
