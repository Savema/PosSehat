<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengukuranIbuHamil extends Model
{
    use HasFactory;

    protected $table = 'pengukuran_ibu_hamil';

    protected $fillable = [
        'ibu_hamil_id',
        'user_id',
        'tanggal',
        'berat_badan',
        'tinggi_badan',
        'lila',
        'usia_kehamilan',
        'imt',
        'status_gizi'
    ];

    public function ibuHamil()
    {
        return $this->belongsTo(IbuHamil::class, 'ibu_hamil_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
