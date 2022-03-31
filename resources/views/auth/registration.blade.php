<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/register/style.css">
    <title>Halaman Registrasi</title>
</head>
<body>
    <div class="kotakTengah">
        <ul class="box-wrapped">
            <li class="li1">
                <img src="image/login/logokab.png" alt="">
            </li>
            <li class="li2">
                <h3>Daftar</h3>
                <form class="myForm">
                    <label for="username">Username </label>
                    <div class="input-form">
                        <input type="text" name="username" id="username" required>
                    </div>
                    
                    <label for="email_address">Jenis Kelamin </label>
                    <div class="input-form">
                        <select id="gender" name="gender" class="dropdown">
                            <option value=""></option>
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                          </select>
                    </div>
    
                    <label for="address">Alamat </label>
                    <div class="input-form">
                        <input type="text" name="address" id="address" required>
                    </div>
                    
                    <label for="phone">Telepon </label>
                    <div class="input-form">
                        <input type="text" name="phone" id="phone">
                    </div>
    
                    <label for="telp">Email </label>
                    <div class="input-form">
                        <input type="email" name="email" id="email" required>
                    </div>

                    <label for="username">Username </label>
                    <div class="input-form">
                        <input type="text" name="username" id="username" required>
                    </div>
                    
                    <label for="email_address">Password </label>
                    <div class="input-form">
                        <input type="password" name="password" id="password">
                    </div>
    
                    
                    <label for="email_address">Konfirmasi Password </label>
                    <div class="input-form">
                        <input type="password" name="password" id="password">
                    </div>
    
                  

                    <button>Daftar</button>
                </form>
                <span>Sudah punya akun? <a href="/login">Masuk</a></span>
            </li>
            
        </ul>
        

    </div>
	
</body>
</html>