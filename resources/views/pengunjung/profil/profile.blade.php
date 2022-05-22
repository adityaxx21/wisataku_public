@extends('pengunjung.layout.homePengunjung')
@section('pengunjung')
    <div class="box pengunjung mb-5">
        <div class="x_content">
            <h3>Profile <span class="title">Pengunjung</span></h3>
            <form action="/pengunjungDashboard/profile" method="post" enctype="multipart/form-data" id="form-sub">
                @csrf
                <div class="row mt-5">
                    <div class="col-md-3 col-sm-12 form-group">
                        Foto
                        <div class="profile_img mt-2">
                            <div id="crop-avatar">
                                <!-- Current avatar -->
                                <img class="img-responsive avatar-view" height="200" width="200"
                                src="{{asset("$get_data->gambar")}}" alt="Avatar"  title="Change the avatar">
                            </div>
                        </div>


                        <div id="input-btn" class="btn btn-primary mt-3" onclick="getFile()">Pilih File</div>


                        <div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" type="file"  name="gambar"
                                onchange="sub(this)" /></div>
                    </div>

                    <div class="col-md-4 col-sm-12 form-group">
                        <label for="telp">Nomor Telepon </label>
                        <input type="text" {{-- placeholder="NomorTelepon" --}} class="form-control" name="telp" value="{{$get_data->Telepon}}">

                        <label for="alamat" class="mt-3">Alamat </label>
                        <input type="text" {{-- placeholder="Alamat" --}} class="form-control" name="alamat" value="{{$get_data->Alamat}}">

                        <label for="email" class="mt-3">Email </label>
                        <input type="text" {{-- placeholder="AlamatEmail" --}} class="form-control" name="email" value="{{$get_data->Email}}">
                    </div>


                    <div class="col-md-4 col-sm-12  ml-5 form-group">
                        <label for="username">Username </label>
                        <input type="text" {{-- placeholder="Username" --}} class="form-control" name="username" value="{{$get_data->uname}}">

                        <label for="ubahpass" class="mt-3">Ubah Password </label>
                        <input type="text" class="form-control" name="ubahpass" value="{{$get_data->pass}}">

                        <label for="confirmpass" class="mt-3">Ulangi Password </label>
                        <input type="text" class="form-control" name="confirmpass" value="{{$get_data->pass}}">
                    </div>
                </div>
            </form>
            <center><span id="submite" class="btn btn-success" onclick="submit()"><i class="fa fa-save"></i> Simpan Perubahan</span></center>
        </div>
    </div>

    @push('button_input')
        <script>
            function getFile() {
                document.getElementById("upfile").click();
            }

            function sub(obj) {
                var file = obj.value;
                var fileName = file.split("\\");
                document.getElementById("yourBtn").innerHTML = fileName[fileName.length - 1];
                document.myForm.submit();
                event.preventDefault();
            }
            function submit() {
                $('#form-sub').submit();
            }
        </script>
    @endpush
@endsection
