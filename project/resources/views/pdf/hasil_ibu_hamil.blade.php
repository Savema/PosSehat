<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengukuran Ibu Hamil - {{ $pengukuran->ibuHamil->nama ?? 'Data' }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #FF782D; padding-bottom: 10px; }
        .header h2 { color: #FF782D; margin: 0; text-transform: uppercase; font-size: 18px; }
        .header p { margin: 5px 0; color: #666; font-size: 10px; letter-spacing: 1px; }

        .info-box {
            background-color: #fff5f0; /* Oranye sangat muda */
            border-left: 5px solid #FF782D;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 11px;
            border-radius: 0 5px 5px 0;
        }

        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #eee; padding: 10px; text-align: left; }
        .table th { background-color: #fafafa; color: #555; font-weight: bold; width: 35%; }

        .section-title {
            color: #FF782D;
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ffccbc;
            padding-bottom: 5px;
        }

        .chart-container { text-align: center; margin: 20px 0; padding: 10px; border: 1px solid #f9f9f9; }
        .chart-image { width: 100%; max-width: 580px; }

        .edukasi-item { margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px dashed #eee; }
        .edukasi-item strong { color: #FF782D; font-size: 12px; }

        .rekomendasi {
            margin-top: 20px;
            background-color: #fffaf0;
            border: 1px solid #ffeccb;
            padding: 15px;
            border-radius: 8px;
            color: #856404;
        }

        .footer {
            margin-top: 40px;
            border-top: 1px solid #eee;
            padding-top: 10px;
            font-style: italic;
            font-size: 9px;
            color: #999;
            text-align: right;
        }

        .text-bold { font-weight: bold; }
        .status-text { color: #FF782D; font-weight: bold; font-size: 13px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN HASIL PENGUKURAN IBU HAMIL</h2>
        <p>Aplikasi PosSehat Digital - Kesehatan Ibu & Anak</p>
    </div>

    <div class="info-box">
        <span class="text-bold">Panduan Indeks Massa Tubuh (IMT):</span><br>
        IMT memantau status gizi Ibu selama kehamilan:<br>
        • <span class="text-bold">Kurang:</span> < 18.5 |
        <span class="text-bold">Normal:</span> 18.5 - 24.9 |
        <span class="text-bold">Lebih:</span> 25.0 - 29.9 |
        <span class="text-bold">Obesitas:</span> > 30.0
    </div>

    <table class="table">
        <tr>
            <th>Nama Ibu Hamil</th>
            <td><strong style="font-size: 13px;">{{ $pengukuran->ibuHamil->nama ?? '-' }}</strong></td>
        </tr>
        <tr>
            <th>Tanggal Pemeriksaan</th>
            <td>{{ \Carbon\Carbon::parse($pengukuran->tanggal)->translatedFormat('d F Y') }}</td>
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
            <td><span class="status-text">{{ strtoupper($pengukuran->status_gizi) }}</span></td>
        </tr>
    </table>

    <div class="section-title">Grafik Perkembangan (BB & IMT)</div>
    <div class="chart-container">
        @if($chartImage)
            <img src="{{ $chartImage }}" class="chart-image">
        @else
            <p style="color: #999;">Grafik visual tidak tersedia dalam laporan ini.</p>
        @endif
    </div>

    <div class="section-title">Edukasi & Rekomendasi</div>
    <div class="rekomendasi">
        <strong>Pesan Petugas Kesehatan:</strong><br>
        @if(strtolower($pengukuran->status_gizi) == 'ibu hamil gizi normal')
            Status gizi Ibu terpantau <strong>Baik/Normal</strong>. Pertahankan asupan nutrisi seimbang, konsumsi tablet tambah darah, dan rutin lakukan kontrol kehamilan.
        @else
            Status gizi Ibu memerlukan perhatian lebih. Mohon konsultasikan hasil ini dengan Bidan atau Dokter untuk mengatur pola makan yang ideal.
        @endif
    </div>

    <div style="margin-top: 15px;">
        @foreach($edukasi as $item)
            <div class="edukasi-item">
                <strong>{{ $item->judul }}</strong>
                <p style="margin: 3px 0 0 0; color: #555;">{{ $item->konten }}</p>
            </div>
        @endforeach
    </div>

    <div class="footer">
        Dicetak pada: {{ date('d-m-Y H:i') }} | Petugas: {{ $pengukuran->petugas->nama ?? 'Sistem PosSehat' }}
    </div>
</body>
</html>
