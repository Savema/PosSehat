<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Edukasi;
use App\Models\Edukasi2;
use App\Models\IbuHamil;
use App\Models\PengukuranIbuHamil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PengukuranIbuHamilController extends Controller
{
    public function index()
    {

        $p_ibuhamil = PengukuranIbuHamil::with(['ibuHamil','petugas'])->get();

        // $ibu->usia = Carbon::parse($ibu->tgl_lahir)->age;
        // return $ibu;
        return view('pengukuran_ibuhamil.data', compact('p_ibuhamil'));
    }

    public function create()
    {
        $ibu_hamil = IbuHamil::all();

        return view('pengukuran_ibuhamil.create', compact('ibu_hamil'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ibu_hamil_id' => 'required|exists:ibu_hamil,id',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'lila' => 'nullable|numeric',
            'usia_kehamilan' => 'required|integer',
        ]);

        DB::transaction(function () use ($request) {

            // Hitung IMT
            $tb_meter = $request->tinggi_badan / 100;

            if ($tb_meter <= 0) {
                $imt = 0;
            } else {
                $imt = $request->berat_badan / ($tb_meter * $tb_meter);
            }

            // Status Gizi
            if ($imt < 18.5) {
                $status_gizi = 'ibu hamil gizi kurang';
            } elseif ($imt <= 24.9) {
                $status_gizi = 'ibu hamil gizi normal';
            } elseif ($imt <= 29.9) {
                $status_gizi = 'ibu hamil gizi lebih';
            } else {
                $status_gizi = 'ibu hamil obesitas';
            }

            // Simpan Pengukuran
            $pengukuran = PengukuranIbuHamil::create([
                'ibu_hamil_id' => $request->ibu_hamil_id,
                'user_id' => Auth::id(),
                'tanggal' => now(),
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
                'lila' => $request->lila,
                'usia_kehamilan' => $request->usia_kehamilan,
                'imt' => round($imt,2),
                'status_gizi' => $status_gizi,
            ]);

            // Ambil Template Edukasi
            $template = Edukasi::where('kategori', $status_gizi)->get();

            // Simpan Edukasi Hasil
            foreach ($template as $item) {

                Edukasi2::create([
                    'ibu_hamil_id' => $request->ibu_hamil_id,
                    'pengukuran_ibu_hamil_id' => $pengukuran->id,
                    'judul' => $item->judul,
                    'konten' => $item->konten,
                    'kategori' => $status_gizi
                ]);

            }

        });

        return redirect()->route('pengukuran_ibu_hamil.index')
            ->with('success','Hasil pemeriksaan dan edukasi berhasil disimpan!');
    }

    public function destroy($id)
    {
        $p_ibuhamil = PengukuranIbuHamil::findOrFail($id);
        $p_ibuhamil->delete();

        return redirect()->route('pengukuran_ibu_hamil.index')->with('success','Data berhasil dihapus');
    }

    public function detail($id)
    {
        // ambil pengukuran yang dipilih
        $pengukuran = PengukuranIbuHamil::with('ibuHamil')->findOrFail($id);

        // ambil semua riwayat pengukuran ibu tersebut
        $pengukurans = PengukuranIbuHamil::where('ibu_hamil_id', $pengukuran->ibu_hamil_id)
                        ->orderBy('tanggal','asc')
                        ->get();

        // ambil edukasi
        $edukasi = Edukasi2::where('pengukuran_ibu_hamil_id', $id)->get();

        // data untuk grafik
        $tanggal = $pengukurans->pluck('tanggal');
        $bb = $pengukurans->pluck('berat_badan');
        $imt = $pengukurans->pluck('imt');

        return view('pengukuran_ibuhamil.detail', compact(
            'pengukuran',
            'pengukurans',
            'edukasi',
            'tanggal',
            'bb',
            'imt'
        ));
    }

    public function cetakPdf(Request $request, $id)
    {
        $pengukuran = PengukuranIbuHamil::with(['petugas','ibuHamil'])->findOrFail($id);
        $edukasi = Edukasi2::where('pengukuran_ibu_hamil_id', $id)->get();
        $chartImage = $request->chartImage;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'pdf.hasil_ibu_hamil',
            compact('pengukuran','edukasi','chartImage')
        );

        return $pdf->download('laporan_ibu_hamil.pdf');
    }

}

