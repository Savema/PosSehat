<!DOCTYPE html>
<html>
<head>
    <title>Laporan Hasil Pengukuran Balita</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .chart-container { text-align: center; margin-top: 20px; }
        .chart-image { width: 100%; max-width: 600px; border: 1px solid #eee; }
        .footer { margin-top: 30px; font-style: italic; font-size: 10px; }
        .badge { padding: 5px 10px; border-radius: 5px; color: white; }
        .bg-danger { background-color: #dc3545; }
        .bg-warning { background-color: #ffc107; color: black; }
        .bg-success { background-color: #28a745; }
        .info-box {
            background-color: #f8f9fa;
            border-left: 5px solid #9c3a5b;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 11px;
            line-height: 1.4;
        }
        .text-bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN HASIL PENGUKURAN STUNTING</h2>
        <p>Aplikasi Possehat - Balita</p>
    </div>

    <div class="info-box">
        <span class="text-bold">Panduan Rentang Z-Score (TB/U):</span><br>
        Z-Score adalah nilai standar WHO untuk mengukur tinggi badan anak dibanding anak seusianya:<br>
        • <span class="text-bold">Normal:</span> -2 SD sampai +3 SD (Tinggi badan sesuai usia).<br>
        • <span class="text-bold">Pendek (Stunted):</span> -3 SD sampai < -2 SD.<br>
        • <span class="text-bold">Sangat Pendek (Severely Stunted):</span> Di bawah -3 SD.
    </div>

    <table class="table">
        <tr><th>Nama Balita</th><td>{{ $pengukuran->balita->nama }}</td></tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>
                @if($pengukuran->balita->jenis_kelamin == 'L' || $pengukuran->balita->jenis_kelamin == '1')
                    Laki-laki
                @else
                    Perempuan
                @endif
            </td>
        </tr>
        <tr><th>Usia</th><td>{{ $pengukuran->usia_saat_ukur }} Bulan</td></tr>
        <tr><th>Tanggal Periksa</th><td>{{ $pengukuran->tanggal }}</td></tr>
        <tr><th>Tinggi / Berat</th><td>{{ $pengukuran->tinggi_badan }} cm / {{ $pengukuran->berat_badan }} kg</td></tr>
        <tr><th>Z-Score TB/U</th><td>{{ number_format($pengukuran->zs_tbu, 2) }}</td></tr>
        <tr>
            <th>Status Hasil</th>
            <td><strong>{{ $pengukuran->hasil }}</strong></td>
        </tr>
    </table>

    <h3>Grafik Perkembangan</h3>
    <div class="chart-container">
        @if($chartImage)
            <img src="{{ $chartImage }}" class="chart-image">
        @else
            <p>Grafik tidak tersedia</p>
        @endif
    </div>

    <h3>Edukasi Kesehatan</h3>
    @foreach($edukasi as $item)
        <div style="margin-bottom: 10px;">
            <strong>{{ $item->judul }}</strong>
            <p>{{ $item->konten }}</p>
        </div>
    @endforeach

    <div style="margin-top: 20px; border: 1px solid #ccc; padding: 10px;">
        <span class="text-bold">Rekomendasi Petugas:</span><br>
        @if($pengukuran->hasil == 'Normal')
            Pertahankan pola makan bergizi seimbang dan rutin datang ke Posyandu setiap bulan untuk memantau tumbuh kembang.
        @else
            Segera konsultasikan hasil ini dengan Tenaga Kesehatan atau Dokter di Puskesmas terdekat untuk penanganan lebih lanjut.
        @endif
    </div>

    <div class="footer">
        Dicetak pada: {{ date('d-m-Y H:i:s') }} oleh Petugas: {{ $pengukuran->petugas->nama ?? 'Sistem' }}
    </div>
</body>
</html>
