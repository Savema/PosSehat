<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Edukasi Ibu Hamil</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2{
            text-align:center;
            margin-bottom:5px;
        }

        .subjudul{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:10px;
        }

        table th, table td{
            border:1px solid #000;
            padding:6px;
            text-align:center;
        }

        table th{
            background:#f2f2f2;
        }

        .section{
            margin-top:25px;
        }

        .edukasi{
            margin-bottom:10px;
        }

        .edukasi b{
            font-size:13px;
        }

    </style>
</head>

<body>

<h2>Laporan Hasil dan Edukasi Ibu Hamil</h2>
<p class="">Keterangan:</p>
<p>BB: Berat Badan</p>
<p>TB: Tinggi Badan</p>
<p>LILA: Lingkar Lengan</p>
<h3>Hasil Pengukuran</h3>


<table>
    <thead>
        <tr>
            <th>Petugas</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Usia</th>
            <th>BB</th>
            <th>TB</th>
            <th>LILA</th>
            <th>Usia Kehamilan</th>
            <th>IMT</th>
            <th>Status Gizi</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $pengukuran->petugas->nama ?? '-' }}</td>
            <td>{{ $pengukuran->tanggal }}</td>
            <td>{{ $pengukuran->ibuHamil->nama ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($pengukuran->ibuHamil->tgl_lahir)->age ?? '-' }}</td>
            <td>{{ $pengukuran->berat_badan }}</td>
            <td>{{ $pengukuran->tinggi_badan }}</td>
            <td>{{ $pengukuran->lila }}</td>
            <td>{{ $pengukuran->usia_kehamilan }}</td>
            <td>{{ $pengukuran->imt }}</td>
            <td>{{ $pengukuran->status_gizi }}</td>
        </tr>
    </tbody>
</table>


<div class="section">
    <h3>Grafik Perkembangan Pengukuran</h3>
    @if(!empty($chartImage))
        <img src="{{ $chartImage }}" style="width:100%;">
    @else
        <p>Grafik tidak tersedia</p>
    @endif
</div>


<div class="section">
    <h3>Edukasi dan Informasi</h3>

    @forelse($edukasi as $item)

        <div class="edukasi">
            <b>{{ $item->judul }}</b>
            <p>{{ $item->konten }}</p>
        </div>

    @empty
        <p>Edukasi belum tersedia</p>
    @endforelse
</div>

</body>
</html>
