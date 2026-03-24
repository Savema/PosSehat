@extends('layouts.dashboard')

@section('title','Detail Edukasi Ibu Hamil')

@section('content')

<div class="pagetitle">
    <h1>Detail Edukasi</h1>
</div>


    <section class="section">
      <div class="row align-items-top">
        <div class="col-lg-13">

            <!-- Default Card -->
            <div class="card">
                <div class="card-body">
                    <form id="formPdf" action="/cetak-ibu-hamil/{{ $pengukuran->id }}" method="POST">
                        @csrf

                        <input type="hidden" name="chartImage" id="chartImage">

                        <button type="submit" class="btn btn-danger">
                            Cetak PDF
                        </button>
                    </form>

                    <h5 class="card-title">Hasil Pengukuran</h5>

                    <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle datatable">
                    <thead class="table-light">
                        <tr>
                            <th>Petugas</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Berat Badan</th>
                            <th>Tinggi Badan</th>
                            <th>Lila</th>
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
                                <td class="text-center">{{ $pengukuran->usia_kehamilan }}</td>
                                <td>{{ $pengukuran->imt }}</td>
                                <td>{{ $pengukuran->status_gizi }}</td>
                            </tr>
                    </tbody>
                </table>
            </div>

            <!-- Grafik Perkembangan -->
            <h5 class="card-title">Grafik Perkembangan Pengukuran Ibu Hamil</h5>

            <div id="grafikIbuHamil" style="min-height:350px;"></div>
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
            </div><!-- End Default Card -->
        </div>
      </div>
    </section>
</div>
</div>

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
