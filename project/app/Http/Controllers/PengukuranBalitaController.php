<?php

namespace App\Http\Controllers;

use App\Models\PengukuranBalita;
use Illuminate\Http\Request;

class PengukuranBalitaController extends Controller
{
    public function index()
    {

        $p_balita = PengukuranBalita::with(['balita','petugas'])->get();

        // $ibu->usia = Carbon::parse($ibu->tgl_lahir)->age;
        // return $ibu;
        return view('pengukuran_balita.data', compact('p_balita'));
    }
}
