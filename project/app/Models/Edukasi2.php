<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edukasi2 extends Model
{
    use HasFactory;

    protected $table = 'edukasi';

    protected $fillable = [
        'balita_id',
        'ibu_hamil_id',
        'pengukuran_ibu_hamil_id',
        'pengukuran_balita_id',
        'judul',
        'konten',
        'kategori',
        // 'gambar'
    ];
}
