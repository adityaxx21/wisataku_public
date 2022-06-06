@extends('layout.index')

@section('container')
    <div class="box tabel-akun">
        <h3>Kelola <span class="title akun">Akun</span></h3>
        <a href="/tambahAkun" class="btn btn-success btn-tambahakun"><i class="fa fa-plus-circle"><span> Tambah
                    Akun</span></i></a>
        <div class="x_content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>User Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=0;
                        foreach ($get_data  as $value) {
                            if ($value->hak_akses != 2) {
                            $no++;?>
                    <tr>
                        <th scope="row">{{ $no }}</th>
                        <td>{{ $value->Nama }}</td>
                        <td>{{ $value->uname }}</td>
                        <td>{{ md5($value->pass) }}</td>
                        <td>{{ $value->jenis_akses }}</td>
                        <td>
                            <a href="/editAkun/{{ $value->id }}" class="btn btn-primary"><i class="fa fa-pencil"><span>
                                        Edit</span></i></a>
                            <form action='/kelolaAkun/delete/{{ $value->id }}' method='post'>
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are You Sure About This ? ')">
                                    <i class="fa fa-trash">
                                        <span>Hapus</span>
                                    </i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php 
                
                }
            }?>
                </tbody>
            </table>
        </div>

    </div>
@endsection
