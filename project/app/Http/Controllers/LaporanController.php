<?php

namespace App\Http\Controllers;

use App\Models\PengukuranBalita;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = PengukuranBalita::with('balita');

        // Filter berdasarkan Status Stunting (Hasil AI)
        if ($request->has('status') && $request->status != '') {
            $query->where('hasil', $request->status);
        }

        // Filter berdasarkan Bulan/Tahun (Optional)
        if ($request->has('bulan') && $request->bulan != '') {
            $query->whereMonth('tanggal', $request->bulan);
        }

        $laporan = $query->latest()->get();

        return view('laporan.index', compact('laporan'));
    }
}
