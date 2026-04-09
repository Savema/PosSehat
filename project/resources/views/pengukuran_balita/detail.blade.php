@extends('layouts.dashboard')

@section('title','Detail Perkembangan Balita')

@section('content')

<div class="pagetitle mb-4">
    <h1 style="color: #FF782D; font-weight: 700;">Laporan Perkembangan Balita</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pengukuran_balita.index') }}">Data Pengukuran</a></li>
            <li class="breadcrumb-item active">Detail Laporan</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 20px;">
                <div class="card-body pt-4">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-orange-light rounded-circle mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-person-badge" style="font-size: 2.5rem; color: #FF782D;"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-0">{{ $pengukuran->balita->nama ?? '-' }}</h4>
                        <span class="text-muted">{{ $pengukuran->usia_saat_ukur }} Bulan</span>
                    </div>

                    <div class="status-box p-3 rounded-4 mb-3 text-center" style="background-color: #f8f9fa;">
                        <small class="text-uppercase fw-bold text-muted d-block mb-1">Status Gizi (TBU)</small>
                        @php
                            $statusClass = match(strtolower($pengukuran->hasil)) {
                                'normal' => 'bg-success',
                                'risiko stunting', 'pendek' => 'bg-warning text-dark',
                                'stunting', 'sangat pendek' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $statusClass }} fs-6 px-4 py-2" style="border-radius: 10px;">
                            {{ $pengukuran->hasil }}
                        </span>
                    </div>

                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Petugas Pemeriksa:</span>
                            <span class="fw-bold">{{ $pengukuran->petugas->nama ?? '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Tanggal Ukur:</span>
                            <span class="fw-bold">{{ \Carbon\Carbon::parse($pengukuran->tanggal)->translatedFormat('d F Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Z-Score TBU:</span>
                            <span class="fw-bold text-primary">{{ number_format($pengukuran->zs_tbu, 2) }}</span>
                        </li>
                    </ul>

                    <form id="formPdf" action="/cetak-balita/{{ $pengukuran->id }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="chartImage" id="chartImage">
                        <button type="submit" class="btn btn-danger w-100 py-2 shadow-sm" style="border-radius: 12px;">
                            <i class="bi bi-file-pdf me-2"></i> Cetak Laporan PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 20px;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #2c3e50;"><i class="bi bi-graph-up-arrow me-2 text-orange"></i>Grafik Antropometri</h5>
                    <div id="grafikBalita"></div>
                </div>
            </div>

            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #2c3e50;"><i class="bi bi-lightbulb me-2 text-warning"></i>Rekomendasi Kesehatan</h5>
                    <div class="edukasi-content mt-2">
                        @forelse($edukasi as $item)
                            <div class="d-flex align-items-start p-3 mb-3 border-0 shadow-sm rounded-4" style="background-color: #fffaf0;">
                                <div class="icon-circle me-3" style="color: #FF782D;">
                                    <i class="bi bi-check2-circle fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1" style="color: #FF782D;">{{ $item->judul }}</h6>
                                    <p class="mb-0 text-muted small" style="line-height: 1.6;">{{ $item->konten }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-light border-0 text-center py-4">
                                <i class="bi bi-info-circle d-block mb-2 fs-2 text-muted"></i>
                                <p class="text-muted mb-0">Edukasi belum tersedia untuk kategori ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-orange-light { background-color: #fff5f0; }
    .text-orange { color: #FF782D; }
    .rounded-4 { border-radius: 1rem !important; }
</style>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // 1. Ambil data dari Controller
    var tanggal = @json($tanggal ?? []);
    var tb = @json($tb ?? []); // Tinggi Badan
    var bb = @json($bb ?? []); // Berat Badan

    // 2. Konfigurasi Grafik
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
            type: 'area', // Menggunakan 'area' agar ada gradasi warna di bawah garis
            height: 350,
            fontFamily: 'Poppins, sans-serif',
            toolbar: { show: false },
            zoom: { enabled: false },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
            }
        },
        // Warna Oranye PosSehat dan Biru Teal sebagai penyeimbang
        colors: ['#FF782D', '#00B4D8'],
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.3,
                opacityTo: 0.1,
                stops: [0, 90, 100]
            }
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        markers: {
            size: 5,
            strokeColors: '#fff',
            strokeWidth: 2,
            hover: { size: 7 }
        },
        xaxis: {
            categories: tanggal,
            title: {
                text: 'Riwayat Tanggal Pengukuran',
                style: { color: '#7a7a7a', fontWeight: 500 }
            },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            title: {
                text: 'Nilai (cm / kg)',
                style: { color: '#7a7a7a', fontWeight: 500 }
            }
        },
        grid: {
            borderColor: '#f1f1f1',
            strokeDashArray: 4,
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            fontWeight: 600
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(1);
                    }
                    return y;
                }
            }
        }
    };

    // 3. Inisialisasi & Render Chart
    var chart = new ApexCharts(document.querySelector("#grafikBalita"), options);
    chart.render();

    // 4. Handle Cetak PDF (Konversi Chart ke Gambar Base64)
    var formPdf = document.getElementById("formPdf");
    if (formPdf) {
        formPdf.addEventListener("submit", function(e) {
            e.preventDefault();

            // Mengambil URI data gambar dari chart sebelum submit form
            chart.dataURI().then(({ imgURI }) => {
                document.getElementById("chartImage").value = imgURI;
                // Gunakan submit asli setelah value input hidden terisi
                this.submit();
            });
        });
    }
});
</script>

@endsection
