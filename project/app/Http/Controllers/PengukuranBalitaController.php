<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\PengukuranBalita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PengukuranBalitaController extends Controller
{
    public function index()
    {

        $p_balita = PengukuranBalita::with(['balita','petugas'])->get();

        // $ibu->usia = Carbon::parse($ibu->tgl_lahir)->age;
        // return $ibu;
        return view('pengukuran_balita.data', compact('p_balita'));
    }

    public function create()
    {
        $balita = Anak::all();

        return view('pengukuran_balita.create', compact('balita'));
    }

    public function store(Request $request)
    {
        // Cek apakah data dari form sampai
        // dd($request->all());

        $request->validate([
            'balita_id'      => 'required',
            'tanggal'        => 'required',
            'usia'           => 'required',
            'jenis_kelamin'  => 'required',
            'berat_badan'    => 'required',
            'tinggi_badan'   => 'required',
            'lingkar_kepala' => 'required',
        ]);

        try {
            $response = Http::post('http://127.0.0.1:5000/predict', [
                'JK'     => (int) $request->jenis_kelamin,
                'Usia'   => (int) $request->usia,
                'Berat'  => (float) $request->berat_badan,
                'Tinggi' => (float) $request->tinggi_badan,
                'LiLA'   => (float) $request->lingkar_kepala,
            ]);

            if ($response->successful()) {
                $hasilML = $response->json();

                $mapHasil = [
                    0 => 'Stunting',          // Z < -3 (Sangat Pendek)
                    1 => 'Risiko Stunting',   // Z < -2 (Pendek)
                    2 => 'Normal'             // Z >= -2 (Normal)
                ];

                // Variabel ini sudah mengambil teks dari array mapHasil
                $teksHasil = $mapHasil[$hasilML['Status_Stunting']] ?? 'Normal';

                $simpan = PengukuranBalita::create([
                    'balita_id'       => $request->balita_id,
                    'user_id'         => auth()->id() ?? 1,
                    'berat_badan'     => $request->berat_badan,
                    'tinggi_badan'    => $request->tinggi_badan,
                    'lingkar_kepala'  => $request->lingkar_kepala,
                    'usia_saat_ukur'  => $request->usia,
                    'tanggal'         => $request->tanggal,
                    'hasil'           => $teksHasil, // LANGSUNG PANGGIL VARIABELNYA DI SINI
                    'zs_tbu'          => $hasilML['Zscore'],
                    'bmi'             => $request->berat_badan / (($request->tinggi_badan/100) ** 2),
                ]);

                // Jika berhasil simpan, pindah ke index
                return redirect()->route('pengukuran_balita.index')->with('success', 'Berhasil!');
            }

            // Jika API Flask error 400/500
            dd("Flask Error: " . $response->body());

        } catch (\Exception $e) {
            // Jika ada error database atau koneksi, layar akan jadi hitam dan muncul pesan errornya
            dd("Laravel Error: " . $e->getMessage());
        }
    }
}
