<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\IbuHamil;
use App\Models\PengukuranBalita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Data Statis
        $total_balita = \App\Models\Anak::count();
        $total_ibu_hamil = \App\Models\IbuHamil::count();
        $total_petugas = \App\Models\User::count();

        // 2. Hitung Balita yang terdeteksi Stunting (Hasil Terakhir)
        $total_stunting = \App\Models\PengukuranBalita::where('hasil', 'sangat pendek')->count();

        // 3. Siapkan Data Grafik (6 Bulan Terakhir)
        $label_bulan = [];
        $grafik_balita = [];
        $grafik_ibu = [];

        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $label_bulan[] = $bulan->translatedFormat('M'); // Contoh: Jan, Feb, Mar

            // Hitung jumlah pengukuran balita di bulan tersebut
            $grafik_balita[] = \App\Models\PengukuranBalita::whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)
                ->count();

            // Hitung jumlah pengukuran ibu hamil di bulan tersebut
            $grafik_ibu[] = \App\Models\PengukuranIbuHamil::whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)
                ->count();
        }

        return view('dashboard.index', compact(
            'total_balita', 'total_ibu_hamil', 'total_petugas',
            'total_stunting', 'label_bulan', 'grafik_balita', 'grafik_ibu'
        ));
    }
}
