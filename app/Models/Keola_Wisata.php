<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keola_Wisata extends Model
{
    use HasFactory;
    protected $table = 'keola_wisata';
    protected $primaryKey = 'id_wisata';

    protected $fillable = [
        'gambar','namaWisata','kategoriWisata','deskripsi','tiketDewasa','tiketAnak','alamat','parkirmotor','parkirmobil','parkirumum','lat','long'
    ];
}
