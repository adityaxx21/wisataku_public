@extends('layout.index')

@section('container')
    <div class="box tambahAkun">
        <h3>Tambah <span class="title akun">Akun</span></h3>
        <form action="" method="post">
            <div class="form-upload">
                <div class="row">
                    <div class="col-md-6 col-sm-12  form-group">
                        <label for="nama" class="label-form">Nama</label>
                        <input type="text" name="nama" placeholder="Nama" class="form-control">
                    </div>

                    <div class="col-md-6 col-sm-12  form-group">
                        <label for="email" class="label-form">Email</label>
                        <input type="email" name="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="col-md-6 col-sm-12  form-group">
                        <label for="username" class="label-form">Username</label>
                        <input type="text" name="username" placeholder="Username" class="form-control">
                    </div>

                    <div class="col-md-6 col-sm-12  form-group">
                        <label for="password" class="label-form">Password</label>
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>

                    <div class="col-md-6 col-sm-12  form-group">
                        <label for="role" class="label-form">Level User</label>
                        <select id="role" name="role" class="form-control role" required="">
                            <option value=""></option>
                            <option value="admin">Admin</option>
                            <option value="pengelola">Pengelola Wisata</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="button-form">
                <button type="button" class="btn btn-success"><i class="fa fa-save"><span> Simpan</span></i></button>
                <button type="button" class="btn btn-warning"><i class="fa fa-repeat"><span> Reset</span></i></button>
                <button type="button" class="btn btn-danger"><i class="fa fa-close"><span> Kembali</span></i></button>
            </div>
        </form>
    </div>
@endsection
