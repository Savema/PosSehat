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
            <h5 class="card-title">Edukasi dan Informasi</h5>
                        @forelse($edukasi as $item)
                            <b>{{ $item->judul }}</b>
                            <p>{{ $item->konten }}</p>
                        @empty
                        <p class="text-danger">Edukasi belum tersedia</p>
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

    var tanggal = @json($tanggal ?? []);
    var bb = @json($bb ?? []);
    var imt = @json($imt ?? []);

    var options = {
        series: [
        {
            name: 'Berat Badan',
            data: bb
        },
        {
            name: 'IMT',
            data: imt
        }
        ],
        chart: {
            type: 'line',
            height: 350
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        markers: {
            size: 6
        },
        xaxis: {
            categories: tanggal
        },
        tooltip: {
            shared: false,
            intersect: true
        },
        colors: ['#2ecc71','#ff7f32']
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
