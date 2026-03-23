<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengukuranBalita extends Model
{
    use HasFactory;

    protected $table = 'pengukuran_balita';

    protected $fillable = [
        'balita_id', 'user_id', 'berat_badan', 'tinggi_badan',
        'lingkar_kepala', 'usia_saat_ukur', 'tanggal',
        'hasil', 'zs_tbu', 'bmi', 'zs_bmi_u', 'status_gizi_bmi'
    ];

    // Perbaiki relasi ini
    public function balita()
    {
        // Sesuaikan 'Anak::class' dengan nama Model Balita kamu
        return $this->belongsTo(Anak::class, 'balita_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
