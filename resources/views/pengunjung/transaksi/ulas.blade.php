@extends('pengunjung.layout.homePengunjung')
@section('pengunjung')
    <div class="box pengunjung mb-5">
        <div class="x_content">
            <div class="row">
                <form action="/pengunjungDashboard/ulas" method="post">
                    @csrf
                    <div class="col-sm-12">
                        <h3>{{$pesan->nama_wisata}}</h3>
                    </div>
                    <div class="col-sm-12 mt-5">
                        <h2>Beri Rating</h2>
                    </div>

                    <div class="rating-css">
                        <div class="star-icon">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i == $pesan->rating)
                                    <input type="radio" value="{{ $i }}" name="product_rating" checked
                                        id="rating{{ $i }}">
                                    <label for="rating{{ $i }}" class="fa fa-star"></label>
                                @else
                                    <input type="radio" value="{{ $i }}" name="product_rating"
                                        id="rating{{ $i }}">
                                    <label for="rating{{ $i }}" class="fa fa-star"></label>
                                @endif
                            @endfor
                        </div>
                    </div>

                    <div class="col-sm-12 mt-5 ulasan">
                        <h2>Beri Komentar Anda</h2>
                        @if ($pesan->is_deleted == 0)
                            {{$readonly = 'readonly'}}
                        @else
                        {{$readonly = ''}}
                        @endif
                        <textarea rows="5" cols="100" class="resizable_textarea form-control" name="komentarUlasan"
                            placeholder="Beri Komentar Kamu" {{$readonly}}>{{$pesan->pesan}}</textarea>

                    </div>

                    <div class="col-sm-12 mt-5">

                        <button type="submit" class="btn btn-success"><i class="fa fa-save"><span>
                                    Simpan</span></i></button>
                        <a href="/kelolaWisata" class="btn btn-danger"><i class="fa fa-close"><span>
                                    Kembali</span></i></a>
                    </div>

                </form>

            </div>
        </div>
    </div>
    </div>
@endsection
