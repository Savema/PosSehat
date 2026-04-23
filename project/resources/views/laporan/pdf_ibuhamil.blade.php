<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Ibu Hamil - PosSehat</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 10pt; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #6f42c1; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #6f42c1; text-transform: uppercase; }
        .header p { margin: 2px 0; font-size: 9pt; color: #666; }

        .info-table { width: 100%; margin-bottom: 20px; font-size: 9pt; }

        table.main-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.main-table th { background-color: #f8f9fa; color: #6f42c1; font-weight: bold; text-transform: uppercase; font-size: 8pt; border: 1px solid #dee2e6; padding: 10px 5px; }
        table.main-table td { border: 1px solid #dee2e6; padding: 8px 5px; text-align: center; }

        .text-left { text-align: left !important; }
        .fw-bold { font-weight: bold; }
        .status-text {
            font-weight: bold;
            font-size: 9pt;
        }

        .status-box {
            display: block;
            padding: 4px;
            border-radius: 4px;
            font-size: 8pt;
            font-weight: bold;
            text-align: center;
            border: 1px solid #ccc; /* Kasih garis pinggir tipis */
        }

        /* Warna spesifik berdasarkan status */
        .status-normal { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .status-kurang { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .status-lebih { color: #856404; background-color: #fff3cd; border-color: #ffeeb8; }

        .footer { margin-top: 40px; width: 100%; }
        .signature { float: right; width: 200px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $title }}</h2>
        <p>Sistem Monitoring Kesehatan & Nutrisi Digital</p>
        <p>{{ $sub }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td width="15%">Tanggal Cetak</td>
            <td width="2%">:</td>
            <td>{{ $date }}</td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th width="3%">No</th>
                <th class="text-left">Nama Ibu</th>
                <th>Usia Hamil</th>
                <th>BB (kg)</th>
                <th>TB (cm)</th>
                <th>LILA (cm)</th>
                <th>IMT</th>
                <th>Status Gizi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="text-left fw-bold">{{ $item->ibuHamil->nama ?? '-' }}</td>
                <td>{{ $item->usia_kehamilan }} Minggu</td>
                <td>{{ $item->berat_badan }}</td>
                <td>{{ $item->tinggi_badan }}</td>
                <td>{{ $item->lila }}</td>
                <td>{{ $item->imt }}</td>
                <td>
                    @php
                        $color = match(strtolower($item->status_gizi)) {
                            'ibu hamil gizi kurang' => 'bg-danger',
                            'ibu hamil gizi normal' => 'bg-success',
                            'ibu hamil gizi lebih', 'ibu hamil obesitas' => 'bg-warning',
                            default => 'bg-secondary'
                        };
                    @endphp
                    <span class="status-badge {{ $color }}">
                        {{ strtoupper($item->status_gizi) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

