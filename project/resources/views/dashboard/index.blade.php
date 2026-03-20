@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<div class="pagetitle mb-4">
    <h1 style="color: #9c3a5b;">Dashboard</h1>
</div>

<section class="section dashboard">
    <div class="row g-4">

        <!-- Balita -->
        <div class="col-xl-4 col-md-6">
            <div class="card info-card h-100">
                <div class="card-body">
                    <h5 class="card-title text-danger">
                        Balita <span>| Total</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-danger">
                            <i class="bi bi-emoji-laughing"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-danger mb-0">{{ $total_balita }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Balita Risiko Stunting -->
        <div class="col-xl-4 col-md-6">
            <div class="card info-card h-100">
                <div class="card-body">
                    <h5 class="card-title text-danger">
                        Pengguna <span>| Total</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-danger">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-danger mb-0">{{ $total_petugas }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ibu Hamil -->
        <div class="col-xl-4 col-md-6">
            <div class="card info-card h-100">
                <div class="card-body">
                    <h5 class="card-title text-danger">
                        Ibu Hamil <span>| Total</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-danger">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-danger mb-0">{{ $total_ibu_hamil }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Sales',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Revenue',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Customers',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

    </div>
</section>

@endsection
