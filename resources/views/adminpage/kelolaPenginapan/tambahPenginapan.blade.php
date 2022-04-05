@extends('layout.index')

@section('container')
    <div class="box tambahAkun">
        <h3>Tambah <span class="title akun">Penginapan</span></h3>
        <form action="" method="post">
            <div class="form-upload">
                <div class="row">
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="nama" class="label-form">Gambar</label>
                        <div class="form-group upfile">
                            <input type="file" id="actual-btn" hidden />
                            <label for="actual-btn">Pilih File</label>
                            <span id="file-chosen">Tidak ada file</span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="namaPenginapan" class="label-form">Nama Penginapan</label>
                        <input type="text" name="namaPenginapan" placeholder="Nama Penginapan" class="form-control" required
                            id="namaWisata">
                    </div>


                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="deskripsi" class="label-form">Deskripsi</label>
                        <div class="x_content">
                            <div id="alerts"></div>
                            <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                                <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i
                                            class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a data-edit="fontSize 5">
                                                <p style="font-size:17px">Huge</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-edit="fontSize 3">
                                                <p style="font-size:14px">Normal</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-edit="fontSize 1">
                                                <p style="font-size:11px">Small</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="btn-group">
                                    <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i
                                            class="fa fa-bold"></i></a>
                                    <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i
                                            class="fa fa-italic"></i></a>
                                    <a class="btn" data-edit="strikethrough" title="Strikethrough"><i
                                            class="fa fa-strikethrough"></i></a>
                                    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i
                                            class="fa fa-underline"></i></a>
                                </div>

                                <div class="btn-group">
                                    <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i
                                            class="fa fa-list-ul"></i></a>
                                    <a class="btn" data-edit="insertorderedlist" title="Number list"><i
                                            class="fa fa-list-ol"></i></a>
                                    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i
                                            class="fa fa-dedent"></i></a>
                                    <a class="btn" data-edit="indent" title="Indent (Tab)"><i
                                            class="fa fa-indent"></i></a>
                                </div>

                                <div class="btn-group">
                                    <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i
                                            class="fa fa-align-left"></i></a>
                                    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i
                                            class="fa fa-align-center"></i></a>
                                    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i
                                            class="fa fa-align-right"></i></a>
                                    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i
                                            class="fa fa-align-justify"></i></a>
                                </div>

                                <div class="btn-group">
                                    <a class="btn" title="Insert picture (or just drag & drop)"
                                        id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                                    <input type="file" data-role="magic-overlay" data-target="#pictureBtn"
                                        data-edit="insertImage" />
                                </div>

                                <div class="btn-group">
                                    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i
                                            class="fa fa-undo"></i></a>
                                    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i
                                            class="fa fa-repeat"></i></a>
                                </div>
                            </div>

                            <div id="editor-one" class="editor-wrapper"></div>

                            <textarea name="deskrisi" id="descr" style="display:none;"></textarea>

                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="hargaPenginapan" class="label-form">Harga Penginapan</label>
                        <input type="text" name="hargaPenginapan" placeholder="Harga Tiket Dewasa" class="form-control duacol" required>
                    </div>

                    <div class="col-md-12 col-sm-12  form-group">
                        <label for="alamat" class="label-form">Alamat</label>
                        <textarea class="resizable_textarea form-control" name="alamat" placeholder="Masukkan Alamat"></textarea>
                    </div>

                    
                    <div class="col-md-6 col-sm-12  form-group">
                        <label for="lat" class="label-form">Latitude</label>
                        <input type="text" name="lat" placeholder="Latitude" class="form-control duacol" required>
                    </div>
                    <div class="col-md-6 col-sm-12  form-group">
                        <label for="long" class="label-form">Longitude</label>
                        <input type="text" name="long" placeholder="Longitude" class="form-control duacol" required>
                    </div>
                    

                </div>
            </div>
            <div class="button-form">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"><span> Simpan</span></i></button>
                <button type="button" class="btn btn-warning reset"><i class="fa fa-repeat"><span>
                            Reset</span></i></button>
                <a href="/kelolaPenginapan" class="btn btn-danger"><i class="fa fa-close"><span> Kembali</span></i></a>
            </div>
            
        </form>
    </div>


    <script src="js/adminPage/formUpload/script.js"></script>
    
    
@endsection
