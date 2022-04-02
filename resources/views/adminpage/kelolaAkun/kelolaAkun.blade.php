@extends('layout.index')

@section('container')
    <div class="box">
        <h3>Kelola <span class="title akun">Akun</span></h3>
        <a href="/tambahAkun" class="btn btn-success btn-tambahakun"><i class="fa fa-plus-circle"><span> Tambah Akun</span></i></a>
        <div class="x_content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><button type="button" class="btn btn-primary"><i class="fa fa-pencil"><span> Edit</span></i></button>
                            <button type="button" class="btn btn-danger"><i class="fa fa-trash"><span> Hapus</span></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td><button type="button" class="btn btn-primary"><i class="fa fa-pencil"><span> Edit</span></i></button>
                            <button type="button" class="btn btn-danger"><i class="fa fa-trash"><span> Hapus</span></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td><button type="button" class="btn btn-primary"><i class="fa fa-pencil"><span> Edit</span></i></button>
                            <button type="button" class="btn btn-danger"><i class="fa fa-trash"><span> Hapus</span></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
