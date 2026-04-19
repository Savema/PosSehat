<?php

namespace App\Exports;

use App\Models\PengukuranBalita;
use App\Models\PengukuranIbuHamil;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;   // <--- Cek ini
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements FromQuery, WithHeadings, WithMapping
{
    protected $bulan, $tahun, $kategori;

    public function __construct($bulan, $tahun, $kategori)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->kategori = $kategori;
    }

    public function query()
    {
        if ($this->kategori == 'balita') {
            return PengukuranBalita::with('balita')
                ->whereMonth('tanggal', $this->bulan) // Harus pakai variabel ini!
                ->whereYear('tanggal', $this->tahun)  // Harus pakai variabel ini!
                ->orderBy('tanggal', 'asc');
        } else {
            return PengukuranIbuHamil::with('ibuHamil')
                ->whereMonth('tanggal', $this->bulan)
                ->whereYear('tanggal', $this->tahun)
                ->orderBy('tanggal', 'asc');
        }
    }

    public function headings(): array
    {
        if ($this->kategori == 'balita') {
            return ["No", "Nama Balita", "Tanggal Ukur", "Usia (Bulan)", "BB (kg)", "TB (cm)", "ZS-TB/U", "Hasil/Status"];
        }
        return ["No", "Nama Ibu", "Tanggal Ukur", "Usia Hamil (Minggu)", "BB (kg)", "LILA (cm)", "IMT", "Status Gizi"];
    }

    public function map($item): array
    {
        static $no = 1;
        if ($this->kategori == 'balita') {
            return [
                $no++,
                $item->balita->nama ?? '-',
                $item->tanggal,
                $item->usia_saat_ukur,
                $item->berat_badan,
                $item->tinggi_badan,
                $item->zs_tbu,
                $item->hasil
            ];
        }
        return [
            $no++,
            $item->ibuHamil->nama ?? '-',
            $item->tanggal,
            $item->usia_kehamilan,
            $item->berat_badan,
            $item->lila,
            $item->imt,
            $item->status_gizi
        ];
    }
}
