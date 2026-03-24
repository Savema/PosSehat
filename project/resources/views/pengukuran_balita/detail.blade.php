@extends('layouts.dashboard')

@section('title','Detail Edukasi Balita')

@section('content')

<div class="pagetitle">
    <h1>Detail Edukasi & Perkembangan Balita</h1>
</div>

<section class="section">
    <div class="row align-items-top">
        <div class="col-lg-12">

            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="formPdf" action="/cetak-balita/{{ $pengukuran->id }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="chartImage" id="chartImage">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-file-pdf"></i> Cetak PDF
                        </button>
                    </form>

                    <h5 class="card-title">Hasil Pengukuran Terakhir</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Petugas</th>
                                    <th>Tanggal</th>
                                    <th>Nama Balita</th>
                                    <th>Usia (Bulan)</th>
                                    <th>Berat Badan</th>
                                    <th>Tinggi Badan</th>
                                    <th>Z-Score TBU</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $pengukuran->petugas->nama ?? '-' }}</td>
                                    <td>{{ $pengukuran->tanggal }}</td>
                                    <td>{{ $pengukuran->balita->nama ?? '-' }}</td>
                                    <td>{{ $pengukuran->usia_saat_ukur }} Bulan</td>
                                    <td>{{ $pengukuran->berat_badan }} kg</td>
                                    <td>{{ $pengukuran->tinggi_badan }} cm</td>
                                    <td>{{ number_format($pengukuran->zs_tbu, 2) }}</td>
                                    <td>
                                        <span class="badge {{ $pengukuran->hasil == 'Normal' ? 'bg-success' : ($pengukuran->hasil == 'Risiko Stunting' ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $pengukuran->hasil }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <h5 class="card-title">Grafik Perkembangan Antropometri</h5>
                    <div id="grafikBalita" style="min-height:350px;"></div>

                    <hr>

                    <h5 class="card-title">Edukasi dan Informasi Kesehatan</h5>
                    <div class="edukasi-content p-3 bg-light rounded">
                        @forelse($edukasi as $item)
                            <div class="mb-3">
                                <h6 class="fw-bold text-primary"><i class="bi bi-info-circle-fill me-2"></i>{{ $item->judul }}</h6>
                                <p class="mb-0">{{ $item->konten }}</p>
                            </div>
                        @empty
                            <p class="text-danger">Edukasi belum tersedia untuk kategori ini.</p>
                        @endforelse
                    </div>
                </div>
            </div></div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    // Ambil data dari Controller
    var tanggal = @json($tanggal ?? []);
    var tb = @json($tb ?? []); // Tinggi Badan
    var bb = @json($bb ?? []); // Berat Badan

    var options = {
        series: [
            {
                name: 'Tinggi Badan (cm)',
                data: tb
            },
            {
                name: 'Berat Badan (kg)',
                data: bb
            }
        ],
        chart: {
            type: 'line',
            height: 350,
            zoom: { enabled: false }
        },
        stroke: {
            curve: 'smooth',
            width: [4, 4]
        },
        markers: {
            size: 5
        },
        xaxis: {
            categories: tanggal,
            title: { text: 'Tanggal Pengukuran' }
        },
        yaxis: {
            title: { text: 'Nilai Pengukuran' }
        },
        colors: ['#9c3a5b', '#2ecc71'], // Warna disesuaikan
        legend: { position: 'top' }
    };

    // Inisialisasi Chart
    var chart = new ApexCharts(document.querySelector("#grafikBalita"), options);
    chart.render();

    // Handle Cetak PDF (Kirim gambar chart ke backend)
    document.getElementById("formPdf").addEventListener("submit", function(e) {
        e.preventDefault();
        chart.dataURI().then(({ imgURI }) => {
            document.getElementById("chartImage").value = imgURI;
            e.target.submit();
        });
    });
});

// Di show.blade.php
var chart = new ApexCharts(document.querySelector("#grafikBalita"), options);
chart.render();

document.getElementById("formPdf").addEventListener("submit", function(e) {
    e.preventDefault();
    chart.dataURI().then(({ imgURI }) => {
        document.getElementById("chartImage").value = imgURI;
        e.target.submit();
    });
});
</script>

@endsection
