<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'balita';

    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'tgl_lahir',
        'nama_ortu',
        'alamat'
    ];

    public function getJenisKelaminTextAttribute()
    {
        return $this->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan';
    }
}
