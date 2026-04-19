<?php

namespace App\Http\Controllers;

use App\Models\PengukuranBalita;
use App\Models\PengukuranIbuHamil;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // Pastikan sudah install laravel-excel
use Barryvdh\DomPDF\PDF;
use App\Exports\LaporanExport; // Tambahkan ini

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Parameter Filter (Default ke bulan & tahun sekarang)
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));

        // 2. Query Data Balita
        $queryBalita = PengukuranBalita::with('balita')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun);

        // 3. Query Data Ibu Hamil
        $queryIbuHamil = PengukuranIbuHamil::with('ibuHamil')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun);

        // 4. Hitung Statistik untuk Summary Cards
        $stats = [
            'total_balita' => $queryBalita->count(),
            'total_ibu'    => $queryIbuHamil->count(),
            'stunting'     => (clone $queryBalita)->whereIn('hasil', ['Stunting', 'Sangat Pendek', 'Pendek'])->count(),
            'normal'       => (clone $queryBalita)->where('hasil', 'Normal')->count(),
        ];

        // 5. Eksekusi Data untuk Tabel
        $laporanBalita = $queryBalita->latest()->get();
        $laporanIbuHamil = $queryIbuHamil->latest()->get();

        return view('laporan.index', compact('laporanBalita', 'laporanIbuHamil', 'stats', 'bulan', 'tahun'));
    }

    public function exportExcel(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $kategori = $request->kategori;

        // CEK: Apakah ada datanya?
        if ($kategori == 'balita') {
            $exists = PengukuranBalita::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->exists();
        } else {
            $exists = PengukuranIbuHamil::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->exists();
        }

        if (!$exists) {
            return back()->with('error', 'Maat, tidak ada data pengukuran untuk periode yang dipilih.');
        }

        return Excel::download(new LaporanExport($bulan, $tahun, $kategori), "Laporan_{$kategori}_{$bulan}_{$tahun}.xlsx");
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->bulan ?? date('n');
        $tahun = $request->tahun ?? date('Y');
        $kategori = $request->kategori;

        if ($kategori == 'balita') {
            $items = PengukuranBalita::with('balita')->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
            $view = 'laporan.pdf_balita';
        } else {
            $items = PengukuranIbuHamil::with('ibuHamil')->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
            $view = 'laporan.pdf_ibuhamil';
        }

        $data = [
            'title'    => 'LAPORAN BULANAN POSYANDU POSSEHAT',
            'sub'      => 'Kategori: ' . ucfirst($kategori) . " - Periode: $bulan/$tahun",
            'date'     => date('d/m/Y'),
            'items'    => $items
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView($view, $data);
        return $pdf->download("Laporan_{$kategori}_{$bulan}_{$tahun}.pdf");
    }
}
