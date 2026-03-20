<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengukuranBalita extends Model
{
    use HasFactory;

    protected $table = 'pengukuran_balita';

    protected $fillable = [
        'balita_id',
        'user_id',
        'tanggal',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'usia_saat_ukur',
        'hasil',
        'zs_tbu'
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
