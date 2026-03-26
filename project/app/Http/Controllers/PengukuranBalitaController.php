<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Edukasi2;
use App\Models\Edukasi;
use App\Models\PengukuranBalita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PengukuranBalitaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $p_balita = PengukuranBalita::with(['balita','petugas'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('balita', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        // $ibu->usia = Carbon::parse($ibu->tgl_lahir)->age;
        // return $ibu;
        return view('pengukuran_balita.data', compact('p_balita', 'search'));
    }

    public function create()
    {
        $balita = Anak::all();

        return view('pengukuran_balita.create', compact('balita'));
    }

    public function store(Request $request)
    {
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
                    0 => 'Stunting',
                    1 => 'Risiko Stunting',
                    2 => 'Normal'
                ];

                $teksHasil = $mapHasil[$hasilML['Status_Stunting']] ?? 'Normal';

                // 1. Simpan Pengukuran (Cukup Sekali Saja)
                $pengukuran = PengukuranBalita::create([
                    'balita_id'       => $request->balita_id,
                    'user_id'         => auth()->id() ?? 1,
                    'berat_badan'     => $request->berat_badan,
                    'tinggi_badan'    => $request->tinggi_badan,
                    'lingkar_kepala'  => $request->lingkar_kepala,
                    'usia_saat_ukur'  => $request->usia,
                    'tanggal'         => $request->tanggal,
                    'hasil'           => $teksHasil,
                    'zs_tbu'          => $hasilML['Zscore'],
                    'bmi'             => $request->berat_badan / (($request->tinggi_badan/100) ** 2),
                ]);

                // 2. Ambil Template Edukasi
                $templates = Edukasi::where('kategori', $teksHasil)->get();

                // 3. Simpan ke tabel Edukasi2
                foreach ($templates as $item) {
                    Edukasi2::create([
                        'balita_id'            => $request->balita_id,
                        'pengukuran_balita_id' => $pengukuran->id,
                        'judul'                => $item->judul,
                        'konten'               => $item->konten,
                        'kategori'             => $teksHasil
                    ]);
                }

                return redirect()->route('pengukuran_balita.index')->with('success', 'Berhasil menyimpan data dan edukasi!');
            }

            // Jika API Flask error
            dd("Flask Error: " . $response->body());

        } catch (\Exception $e) {
            dd("Laravel Error: " . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $p_balita = PengukuranBalita::findOrFail($id);
        $p_balita->delete();

        return redirect()->route('pengukuran_balita.index')->with('success','Data berhasil dihapus');

    }

    public function detail($id)
    {
        // 1. Ambil data pengukuran utama berdasarkan ID yang diklik
        // Gunakan findOrFail supaya kalau ID tidak ada, muncul error 404 bukan 'undefined variable'
        $pengukuran = PengukuranBalita::with(['balita', 'petugas'])->findOrFail($id);

        // 2. Ambil riwayat pertumbuhan balita tersebut untuk grafik
        $riwayat = PengukuranBalita::where('balita_id', $pengukuran->balita_id)
                    ->orderBy('tanggal', 'asc')
                    ->get();

        // 3. Siapkan data untuk grafik ApexCharts
        $tanggal = $riwayat->pluck('tanggal')->toArray();
        $tb = $riwayat->pluck('tinggi_badan')->toArray();
        $bb = $riwayat->pluck('berat_badan')->toArray();

        // 4. Ambil edukasi yang tersimpan untuk pengukuran ini
        $edukasi = Edukasi2::where('pengukuran_balita_id', $id)->get();

        // 5. KIRIM SEMUA KE VIEW (Pastikan 'pengukuran' ada di sini)
        return view('pengukuran_balita.detail', compact(
            'pengukuran',
            'riwayat',
            'edukasi',
            'tanggal',
            'tb',
            'bb'
        ));
    }

    public function cetakPdf(Request $request, $id)
    {
        $pengukuran = PengukuranBalita::with(['petugas','balita'])->findOrFail($id);
        $edukasi = Edukasi2::where('pengukuran_balita_id', $id)->get();
        $chartImage = $request->chartImage;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'pdf.hasil_balita',
            compact('pengukuran','edukasi','chartImage')
        );

        return $pdf->download('laporan_balita.pdf');
    }
}
