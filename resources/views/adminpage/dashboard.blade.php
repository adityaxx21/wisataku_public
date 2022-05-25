@extends('layout.index')

@section('container')
    <div class="box">
        <h3>Dashboard <span class="title">Page</span></h3>
        <div class="container-card d-flex" style="justify-content: center;">
            <div class="card">
                <h4>Jumlah <span class="title">Wisata</span></h4>
                <hr />
                <p>{{ $jumlah_wisata }}</p>

            </div>
            <div class="card">
                <h2>Jumlah <span class="title">Akun</span></h2>
                <hr />
                <p>{{ $jumlah_akun }}</p>

            </div>
            <div class="card">
                <h2>Jumlah <span class="title">Transaksi</span></h2>
                <hr />
                <p>{{ $jumlah_transaksi }}</p>

            </div>
            <div class="card">
                <h2>Jumlah <span class="title">Kategori</span></h2>
                <hr />
                <p>{{ $jumlah_kategori }}</p>

            </div>
            <div class="card">
                <h2>Jumlah <span class="title">360</span></h2>
                <hr />
                <p>{{ $jumlah_360 }}</p>

            </div>
        </div>
    </div>
@endsection
