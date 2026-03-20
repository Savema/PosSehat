<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\IbuHamil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
     public function index()
    {
        $total_ibu_hamil = IbuHamil::count();
        $total_balita = Anak::count();
        $total_petugas = User::count();

        $grafik = IbuHamil::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('count(*) as total')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        return view('dashboard.index', compact( 'total_ibu_hamil', 'total_balita', 'total_petugas', 'grafik'));
    }
}
