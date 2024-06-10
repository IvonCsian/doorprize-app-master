<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;
    protected $table = 'penerima';
    protected $fillable = [
        'id_penerima',
        'id_hadiah',
        'nama_penerima',
        'nama_hadiah',
        'nak',
        'nik',
        'departemen',
        'bagian',
        'status',
    ];


}
