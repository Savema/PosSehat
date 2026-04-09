<!DOCTYPE html>
<html>
<head>
    <title>Laporan Hasil Pengukuran Balita - {{ $pengukuran->balita->nama }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #FF782D; padding-bottom: 10px; }
        .header h2 { color: #FF782D; margin: 0; text-transform: uppercase; font-size: 18px; }
        .header p { margin: 5px 0; color: #777; font-size: 10px; letter-spacing: 1px; }

        .section-title {
            background-color: #fff5f0;
            color: #FF782D;
            padding: 5px 10px;
            font-weight: bold;
            border-left: 4px solid #FF782D;
            margin: 20px 0 10px 0;
        }

        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #eee; padding: 10px; text-align: left; }
        .table th { background-color: #fafafa; color: #555; width: 30%; }

        .info-box {
            background-color: #fdfdfd;
            border: 1px solid #eee;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .chart-container { text-align: center; margin: 20px 0; padding: 10px; border: 1px solid #f1f1f1; }
        .chart-image { width: 100%; max-width: 550px; }

        .edukasi-item { margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px dashed #eee; }
        .edukasi-item strong { color: #FF782D; display: block; margin-bottom: 5px; }

        .rekomendasi {
            margin-top: 20px;
            background-color: #fffaf0;
            border: 1px solid #ffeccb;
            padding: 15px;
            border-radius: 8px;
            color: #856404;
        }

        .footer {
            margin-top: 50px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            text-align: right;
            font-style: italic;
            font-size: 9px;
            color: #999;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-weight: bold;
            color: white;
        }
        .bg-success { background-color: #28a745; }
        .bg-warning { background-color: #f39c12; }
        .bg-danger { background-color: #e74c3c; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN HASIL PENGUKURAN BALITA</h2>
        <p>Aplikasi PosSehat Digital - Monitoring Stunting & Gizi Balita</p>
    </div>

    <div class="section-title">Informasi Dasar & Z-Score</div>
    <div class="info-box">
        <table class="table" style="margin-bottom: 0;">
            <tr>
                <th>Nama Balita</th>
                <td><strong>{{ $pengukuran->balita->nama }}</strong></td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ ($pengukuran->balita->jenis_kelamin == '1') ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <th>Usia Saat Ukur</th>
                <td>{{ $pengukuran->usia_saat_ukur }} Bulan</td>
            </tr>
            <tr>
                <th>Tanggal Periksa</th>
                <td>{{ \Carbon\Carbon::parse($pengukuran->tanggal)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <th>Hasil Pengukuran</th>
                <td>{{ $pengukuran->tinggi_badan }} cm / {{ $pengukuran->berat_badan }} kg</td>
            </tr>
            <tr>
                <th>Z-Score TB/U</th>
                <td>{{ number_format($pengukuran->zs_tbu, 2) }} SD</td>
            </tr>
            <tr>
                <th>Status Hasil</th>
                <td>
                    @php
                        $statusClass = match(strtolower($pengukuran->hasil)) {
                            'normal' => 'bg-success',
                            'pendek', 'risiko stunting' => 'bg-warning',
                            'sangat pendek', 'stunting' => 'bg-danger',
                            default => 'bg-success'
                        };
                    @endphp
                    <span class="status-badge {{ $statusClass }}">{{ strtoupper($pengukuran->hasil) }}</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="section-title">Grafik Perkembangan</div>
    <div class="chart-container">
        @if($chartImage)
            <img src="{{ $chartImage }}" class="chart-image">
        @else
            <p style="color: #999;">Data visual grafik tidak tersedia.</p>
        @endif
    </div>

    <div class="section-title">Rekomendasi & Edukasi</div>
    <div class="rekomendasi">
        <strong>Pesan Petugas:</strong><br>
        @if($pengukuran->hasil == 'Normal')
            Balita berada dalam kondisi <strong>Normal</strong>. Pertahankan asupan gizi yang baik dan rutinlah berkunjung ke Posyandu setiap bulan.
        @else
            Hasil menunjukkan kategori <strong>{{ $pengukuran->hasil }}</strong>. Disarankan untuk segera melakukan konsultasi intensif dengan petugas kesehatan puskesmas terdekat.
        @endif
    </div>

    <div style="margin-top: 20px;">
        @foreach($edukasi as $item)
            <div class="edukasi-item">
                <strong><i class="bi bi-info-circle"></i> {{ $item->judul }}</strong>
                {{ $item->konten }}
            </div>
        @endforeach
    </div>

    <div class="footer">
        Dicetak pada: {{ date('d-m-Y H:i') }} | Petugas: {{ $pengukuran->petugas->nama ?? 'Sistem PosSehat' }}
    </div>
</body>
</html>
