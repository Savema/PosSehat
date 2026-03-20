<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edukasi extends Model
{
    use HasFactory;

    protected $table = 'template_edukasi';

    protected $fillable = [
        'judul',
        'konten',
        'kategori',
        // 'gambar'
    ];

    // public function getJenisKelaminTextAttribute()
    // {
    //     return $this->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan';
    // }
}
