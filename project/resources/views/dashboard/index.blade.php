@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<div class="pagetitle mb-4">
    <h1 style="color: #FF782D; font-weight: 700;">Dashboard Utama</h1>
    <p class="text-muted">Halo <strong>{{ auth()->user()->nama }}</strong>, pantau perkembangan kesehatan posyandu hari ini di sini.</p>
</div>

    <section class="section dashboard">
        <div class="row g-4">

            <div class="col-xl-3 col-md-6">
                <div class="card info-card h-100 border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">Stunting <span class="text-muted">| Total</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger-light text-danger" style="width: 50px; height: 50px; background-color: #ffe5e5;">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6 class="text-danger mb-0" style="font-size: 24px; font-weight: 700;">{{ $total_stunting }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card info-card h-100 border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">Balita <span class="text-muted">| Terdaftar</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #fff5f0; color: #FF782D;">
                                <i class="bi bi-emoji-laughing-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6 style="font-size: 24px; font-weight: 700; color: #2c3e50;">{{ $total_balita }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card info-card h-100 border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">Ibu Hamil <span class="text-muted">| Terdaftar</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #fff5f0; color: #FF782D;">
                                <i class="bi bi-person-heart"></i>
                            </div>
                            <div class="ps-3">
                                <h6 style="font-size: 24px; font-weight: 700; color: #2c3e50;">{{ $total_ibu_hamil }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card info-card h-100 border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title">Petugas <span class="text-muted">| Aktif</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #fff5f0; color: #FF782D;">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div class="ps-3">
                                <h6 style="font-size: 24px; font-weight: 700; color: #2c3e50;">{{ $total_petugas }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm border-0" style="border-radius: 20px;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #2c3e50; font-weight: 600;">
                            Laporan Aktivitas Pengukuran <span class="text-muted" style="font-size: 14px; font-weight: 400;">/ 6 Bulan Terakhir</span>
                        </h5>

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
                                        fontFamily: 'Poppins, sans-serif', // Biar fontnya lebih modern
                                    },
                                    markers: {
                                        size: 5,
                                        colors: ['#FF782D', '#00B4D8'],
                                        strokeColors: '#fff',
                                        strokeWidth: 2,
                                    },
                                    // WARNA BARU: Oranye untuk Balita, Biru Teal untuk Ibu Hamil (sebagai penyeimbang)
                                    colors: ['#FF782D', '#00B4D8'],
                                    fill: {
                                        type: "gradient",
                                        gradient: {
                                            shadeIntensity: 1,
                                            opacityFrom: 0.3,
                                            opacityTo: 0.05, // Gradasi menghilang ke bawah supaya bersih
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
                                        axisBorder: { show: false },
                                        axisTicks: { show: false }
                                    },
                                    grid: {
                                        borderColor: '#f1f1f1',
                                        strokeDashArray: 4, // Garis latar belakang putus-putus biar estetik
                                    },
                                    legend: {
                                        position: 'top',
                                        horizontalAlign: 'right',
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
    </section>



@endsection
