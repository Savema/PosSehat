@extends('layouts.dashboard')

@section('title','Detail Perkembangan Ibu Hamil')

@section('content')

<div class="pagetitle mb-4">
    <h1 style="color: #FF782D; font-weight: 700;">Laporan Kesehatan Ibu Hamil</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pengukuran_ibu_hamil.index') }}">Data Pengukuran</a></li>
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
                            <i class="bi bi-person-heart" style="font-size: 2.5rem; color: #FF782D;"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-0">{{ $pengukuran->ibuHamil->nama ?? '-' }}</h4>
                        <span class="text-muted">{{ \Carbon\Carbon::parse($pengukuran->ibuHamil->tgl_lahir)->age ?? '-' }} Tahun</span>
                    </div>

                    <div class="status-box p-3 rounded-4 mb-3 text-center" style="background-color: #f8f9fa;">
                        <small class="text-uppercase fw-bold text-muted d-block mb-1">Status Gizi (IMT)</small>
                        @php
                            $statusClass = match(strtolower($pengukuran->status_gizi)) {
                                'normal' => 'bg-success',
                                'gizi kurang' => 'bg-danger',
                                'gizi lebih', 'obesitas' => 'bg-warning text-dark',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $statusClass }} fs-6 px-4 py-2" style="border-radius: 10px;">
                            {{ strtoupper($pengukuran->status_gizi) }}
                        </span>
                    </div>

                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Usia Kehamilan:</span>
                            <span class="fw-bold text-orange">{{ $pengukuran->usia_kehamilan }} Minggu</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Nilai IMT:</span>
                            <span class="fw-bold">{{ $pengukuran->imt }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">LILA:</span>
                            <span class="fw-bold">{{ $pengukuran->lila }} cm</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">BB / TB:</span>
                            <span class="fw-bold">{{ $pengukuran->berat_badan }}kg / {{ $pengukuran->tinggi_badan }}cm</span>
                        </li>
                    </ul>

                    <form id="formPdf" action="/cetak-ibu-hamil/{{ $pengukuran->id }}" method="POST" class="mt-4">
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
                    <h5 class="card-title" style="color: #2c3e50;"><i class="bi bi-activity me-2 text-orange"></i>Grafik BB & IMT</h5>
                    <div id="grafikIbuHamil"></div>
                </div>
            </div>

            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #2c3e50;"><i class="bi bi-lightbulb me-2 text-warning"></i>Saran Kesehatan Ibu</h5>
                    <div class="edukasi-content mt-2">
                        @forelse($edukasi as $item)
                            <div class="d-flex align-items-start p-3 mb-3 border-0 shadow-sm rounded-4" style="background-color: #fffaf0;">
                                <div class="icon-circle me-3" style="color: #FF782D;">
                                    <i class="bi bi-info-circle-fill fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1" style="color: #FF782D;">{{ $item->judul }}</h6>
                                    <p class="mb-0 text-muted small" style="line-height: 1.6;">{{ $item->konten }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-light border-0 text-center py-4">
                                <i class="bi bi-info-circle d-block mb-2 fs-2 text-muted"></i>
                                <p class="text-muted mb-0">Edukasi belum tersedia untuk kategori gizi ini.</p>
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

    // Ambil data dari Controller
    var tanggal = @json($tanggal ?? []);
    var imt = @json($imt ?? []); // IMT
    var bb = @json($bb ?? []); // Berat Badan

    var options = {
        series: [
            {
                name: 'Berat Badan (kg)',
                data: bb
            },
            {
                name: 'IMT',
                data: imt
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


    // ✅ WAJIB: buat chart
    var chart = new ApexCharts(document.querySelector("#grafikIbuHamil"), options);

    chart.render();

    // ✅ handle submit
    document.getElementById("formPdf").addEventListener("submit", function(e) {
        e.preventDefault();

        chart.dataURI().then(({ imgURI }) => {
            document.getElementById("chartImage").value = imgURI;

            e.target.submit(); // submit ulang setelah gambar siap
        });
    });

});
</script>

@endsection
