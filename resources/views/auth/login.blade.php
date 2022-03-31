<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <form class="myForm">
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

                    <button>Masuk</button>
                </form>
                <span>Belum punya akun? <a href="/singup">Daftar</a></span>
            </li>
            
        </ul>
        

    </div>
	
</body>
</html>