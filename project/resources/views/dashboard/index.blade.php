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
                            <h6 class="text-danger mb-0">145</h6>
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
                        Balita Risiko Stunting <span>| Total</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-danger">
                            <i class="bi bi-emoji-frown"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-danger mb-0">335</h6>
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
                            <h6 class="text-danger mb-0">45</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
