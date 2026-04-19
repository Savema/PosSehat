<!DOCTYPE html>
<html>
<head>
    <title>Laporan Balita</title>
    <style>
        body { font-family: sans-serif; font-size: 11pt; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; color: #FF782D; }
        .header p { margin: 5px 0; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-size: 10pt; text-transform: uppercase; }
        .status-badge { font-weight: bold; }
        .footer { margin-top: 30px; text-align: right; font-size: 10pt; }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $title }}</h2>
        <p>{{ $sub }}</p>
        <p>Dicetak pada: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Balita</th>
                <th>Usia</th>
                <th>BB (kg)</th>
                <th>TB (cm)</th>
                <th>Z-Score TB/U</th>
                <th>Hasil Stunting</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->balita->nama }}</td>
                <td>{{ $item->usia_saat_ukur }} Bulan</td>
                <td>{{ $item->berat_badan }}</td>
                <td>{{ $item->tinggi_badan }}</td>
                <td>{{ $item->zs_tbu }}</td>
                <td class="status-badge">{{ strtoupper($item->hasil) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
