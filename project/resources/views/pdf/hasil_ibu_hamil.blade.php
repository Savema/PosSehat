<!DOCTYPE html>
<html>
<head>
    <title>Laporan Hasil Pengukuran Ibu Hamil</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .chart-container { text-align: center; margin-top: 20px; }
        .chart-image { width: 100%; max-width: 600px; border: 1px solid #eee; }
        .footer { margin-top: 30px; font-style: italic; font-size: 10px; }
        .text-bold { font-weight: bold; }
        .info-box {
            background-color: #fdf2f5; /* Pink muda khas Ibu Hamil */
            border-left: 5px solid #9c3a5b;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 11px;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="color: #9c3a5b;">LAPORAN HASIL PENGUKURAN IBU HAMIL</h2>
        <p>Aplikasi PosSehat - Kesehatan Ibu & Anak</p>
    </div>

    <div class="info-box">
        <span class="text-bold">Panduan Indeks Massa Tubuh (IMT):</span><br>
        IMT digunakan untuk memantau apakah status gizi Ibu selama kehamilan berada dalam kondisi ideal.<br>
        • <span class="text-bold">Gizi Kurang:</span> < 18.5 |
        <span class="text-bold">Gizi Normal:</span> 18.5 - 24.9 |
        <span class="text-bold">Gizi Lebih:</span> 24.9 - 29.9 |
        <span class="text-bold">Obesitas:</span> > 29.9
    </div>

    <table class="table">
        <tr>
            <th style="width: 30%;">Nama Ibu</th>
            <td>{{ $pengukuran->ibuHamil->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Periksa</th>
            <td>{{ $pengukuran->tanggal }}</td>
        </tr>
        <tr>
            <th>Usia Kehamilan</th>
            <td>{{ $pengukuran->usia_kehamilan }} Minggu</td>
        </tr>
        <tr>
            <th>Berat / Tinggi Badan</th>
            <td>{{ $pengukuran->berat_badan }} kg / {{ $pengukuran->tinggi_badan }} cm</td>
        </tr>
        <tr>
            <th>Lingkar Lengan Atas (LiLA)</th>
            <td>{{ $pengukuran->lila }} cm</td>
        </tr>
        <tr>
            <th>Nilai IMT</th>
            <td>{{ number_format($pengukuran->imt, 2) }}</td>
        </tr>
        <tr>
            <th>Status Gizi</th>
            <td><strong style="color: #9c3a5b;">{{ $pengukuran->status_gizi }}</strong></td>
        </tr>
    </table>

    <h3>Grafik Perkembangan (BB & IMT)</h3>
    <div class="chart-container">
        @if($chartImage)
            <img src="{{ $chartImage }}" class="chart-image">
        @else
            <p style="color: red;">Grafik tidak tersedia. Pastikan grafik muncul di layar sebelum mencetak.</p>
        @endif
    </div>

    <h3>Edukasi & Informasi Kesehatan</h3>
    @forelse($edukasi as $item)
        <div style="margin-bottom: 12px; border-bottom: 1px solid #eee; padding-bottom: 5px;">
            <strong style="color: #9c3a5b;">{{ $item->judul }}</strong>
            <p style="margin-top: 5px;">{{ $item->konten }}</p>
        </div>
    @empty
        <p>Edukasi belum tersedia.</p>
    @endforelse

    <div style="margin-top: 20px; border: 1px solid #9c3a5b; padding: 10px; border-radius: 5px;">
        <span class="text-bold">Rekomendasi Medis:</span><br>
        @if($pengukuran->status_gizi == 'Normal')
            Status gizi Ibu terpantau baik. Pertahankan asupan nutrisi seimbang, konsumsi tablet tambah darah, dan rutin lakukan kontrol kehamilan sesuai jadwal.
        @else
            Ibu disarankan untuk berkonsultasi lebih lanjut dengan Bidan atau Dokter di Puskesmas mengenai pola makan dan kenaikan berat badan yang ideal selama kehamilan.
        @endif
    </div>

    <div class="footer">
        Dicetak pada: {{ date('d-m-Y H:i:s') }} oleh Petugas: {{ $pengukuran->petugas->nama ?? 'Sistem PosSehat' }}
    </div>
</body>
</html>
