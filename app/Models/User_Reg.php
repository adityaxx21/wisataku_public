<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Reg extends Model
{
    use HasFactory;
    protected $table = 'user_reg';
    protected $primaryKey = 'id';

    protected $fillable = [
        'Nama','Jenis_Kel','Alamat','Telepon','Email','uname','pass'
    ];
    
}
