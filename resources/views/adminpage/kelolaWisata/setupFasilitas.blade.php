@extends('layout.index')

@section('container')
<!-- Modal -->
<div class="modal fade" id="modal-fasilitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Fasilitas Yang Tersedia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @php
              foreach()
          @endphp
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

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
