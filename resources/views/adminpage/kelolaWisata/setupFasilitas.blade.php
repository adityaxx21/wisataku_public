@extends('layout.index')

@section('container')
    <div class="box setupFasilitas">
        <h3>Tambah <span class="title akun">Wisata</span></h3>
        <img src="https://dummyimage.com/400x300/f0f0f0/000" alt="">
        <h4>Nama Wisata</h4>
        <h6>Fasilitas Yang Tersedia</h6>
        <form action="" method="post">
            <label class="container-check">Kamar Mandi
                <input type="checkbox" name="toilet">
                <span class="checkmark"></span>
            </label>
            <label class="container-check">Mushola
                <input type="checkbox" name="mushola">
                <span class="checkmark"></span>
            </label>
            <label class="container-check">Parkir Luas
                <input type="checkbox" name="parkirLuas">
                <span class="checkmark"></span>
            </label>
            <label class="container-check">Wi-Fi
                <input type="checkbox" name="wifi">
                <span class="checkmark"></span>
            </label>
            <label class="container-check">Rumah Makan
                <input type="checkbox" name="rumahMakan">
                <span class="checkmark"></span>
            </label>
            <div class="space20"></div>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"><span> Simpan</span></i></button>
            <button type="button" class="btn btn-warning reset"><i class="fa fa-repeat"><span>
                        Reset</span></i></button>
        </form>
    </div>
@endsection
