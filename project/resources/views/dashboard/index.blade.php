@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<div class="pagetitle mb-4">
    <h1 style="color: #9c3a5b;">Dashboard Utama</h1>
</div>

<section class="section dashboard">
    <div class="row g-4">

        <div class="col-xl-3 col-md-6">
            <div class="card info-card h-100 border-start border-danger border-4">
                <div class="card-body">
                    <h5 class="card-title">Stunting <span>| Total</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger text-white">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-danger mb-0">{{ $total_stunting }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card info-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Balita <span>| Terdaftar</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary-light text-primary">
                            <i class="bi bi-emoji-laughing"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $total_balita }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card info-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Ibu Hamil <span>| Terdaftar</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success-light text-success">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $total_ibu_hamil }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card info-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Petugas <span>| Aktif</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-info-light text-info">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $total_petugas }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Laporan Aktivitas Pengukuran <span>/6 Bulan Terakhir</span></h5>

                    <div id="reportsChart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            new ApexCharts(document.querySelector("#reportsChart"), {
                                series: [{
                                    name: 'Pengukuran Balita',
                                    data: @json($grafik_balita)
                                }, {
                                    name: 'Pengukuran Ibu Hamil',
                                    data: @json($grafik_ibu)
                                }],
                                chart: {
                                    height: 350,
                                    type: 'area',
                                    toolbar: { show: false },
                                },
                                markers: { size: 4 },
                                colors: ['#9c3a5b', '#2eca6a'],
                                fill: {
                                    type: "gradient",
                                    gradient: {
                                        shadeIntensity: 1,
                                        opacityFrom: 0.3,
                                        opacityTo: 0.4,
                                        stops: [0, 90, 100]
                                    }
                                },
                                dataLabels: { enabled: false },
                                stroke: {
                                    curve: 'smooth',
                                    width: 3
                                },
                                xaxis: {
                                    categories: @json($label_bulan),
                                },
                                tooltip: {
                                    x: { format: 'dd/MM/yy' },
                                }
                            }).render();
                        });
                    </script>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
