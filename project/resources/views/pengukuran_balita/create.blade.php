@extends('layouts.dashboard')

@section('title', 'Form Pengukuran Balita')

@section('content')
    <div class="pagetitle mb-4">
        <h1 style="color: #FF782D; font-weight: 700;">Form Pengukuran Balita</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pengukuran_balita.index') }}">Riwayat Pengukuran</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
        </nav>
    </div>

    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card shadow-sm border-0" style="border-radius: 20px;">
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-4">
                  <div class="icon-box me-3" style="background: #fff5f0; padding: 10px; border-radius: 12px;">
                      <i class="bi bi-rulers" style="color: #FF782D; font-size: 1.5rem;"></i>
                  </div>
                  <h5 class="card-title mb-0" style="color: #2c3e50; font-weight: 600;">Input Hasil Pengukuran Posyandu</h5>
              </div>

                @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm" style="border-radius: 12px;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

              <form action="{{ route('pengukuran_balita.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Pengukuran</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar-check text-muted"></i></span>
                            <input type="date" class="form-control border-start-0 custom-input" name="tanggal" id="tanggal_ukur" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Balita</label>
                        <select name="balita_id" id="balita_id" class="form-select custom-input" required>
                            <option value="" selected disabled></option>
                            @foreach($balita as $b)
                                <option value="{{ $b->id }}"
                                    data-tgl="{{ $b->tgl_lahir }}"
                                    data-jk="{{ $b->jenis_kelamin }}">
                                    {{ $b->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-muted">Jenis Kelamin</label>
                        <input type="text" id="jk_display" class="form-control bg-light border-0 px-3" readonly placeholder="Otomatis" style="border-radius: 10px;">
                        <input type="hidden" name="jenis_kelamin" id="jk_input">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-muted">Usia Saat Ini</label>
                        <input type="text" id="usia_display" class="form-control bg-light border-0 px-3" readonly placeholder="Otomatis (Bulan)" style="border-radius: 10px;">
                        <input type="hidden" name="usia" id="usia_input">
                    </div>

                    <div class="col-12"><hr class="my-4 opacity-25"></div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Berat Badan (kg)</label>
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control custom-input text-center fs-5 fw-bold" name="berat_badan" required placeholder="0.00">
                            <span class="input-group-text bg-light border-start-0 text-muted">kg</span>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Tinggi Badan (cm)</label>
                        <div class="input-group">
                            <input type="number" step="0.1" class="form-control custom-input text-center fs-5 fw-bold" name="tinggi_badan" required placeholder="0.0">
                            <span class="input-group-text bg-light border-start-0 text-muted">cm</span>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Lingkar Kepala (cm)</label>
                        <div class="input-group">
                            <input type="number" step="0.1" class="form-control custom-input text-center fs-5 fw-bold" name="lingkar_kepala" required placeholder="0.0">
                            <span class="input-group-text bg-light border-start-0 text-muted">cm</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top mt-4 pt-4">
                    <a href="{{ route('pengukuran_balita.index') }}" class="btn btn-light px-4" style="border-radius: 10px;">Batal</a>
                    <button type="submit" class="btn btn-orange px-4 py-2" style="background-color: #FF782D; color: white; border-radius: 10px; font-weight: 600; border: none;">
                        <i class="bi bi-calculator me-2"></i>Simpan & Hitung Status
                    </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

<style>
    .custom-input:focus {
        border-color: #FF782D !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 120, 45, 0.1) !important;
    }
    .input-group-text { border-radius: 10px 0 0 10px; }
    .custom-input { border-radius: 0 10px 10px 0 !important; }
    /* Untuk input angka di baris fisik */
    .col-md-4 .custom-input { border-radius: 10px 0 0 10px !important; }
    .col-md-4 .input-group-text { border-radius: 0 10px 10px 0; }
</style>

<script>
$(document).ready(function() {
    // Inisialisasi Select2
    $('#balita_id').select2({
        placeholder: 'Cari nama balita...',
        allowClear: true,
        width: '100%'
    });

    // Event change untuk Select2 harus pakai .on('change')
    $('#balita_id').on('change', function() {
        updateData();
    });

    // Event change tanggal tetap sama
    document.getElementById("tanggal_ukur").addEventListener("change", updateData);
});

function updateData() {
    let sel = document.getElementById("balita_id");
    let opt = sel.options[sel.selectedIndex];

    if (opt && opt.value) {
        let jk = opt.getAttribute("data-jk");
        document.getElementById("jk_display").value = (jk == 1) ? "Laki-laki" : "Perempuan";
        document.getElementById("jk_input").value = jk;

        let tglLahir = new Date(opt.getAttribute("data-tgl"));
        let tglUkur = new Date(document.getElementById("tanggal_ukur").value);
        let totalBulan = (tglUkur.getFullYear() - tglLahir.getFullYear()) * 12
                        + (tglUkur.getMonth() - tglLahir.getMonth());
        if (tglUkur.getDate() < tglLahir.getDate()) totalBulan--;

        document.getElementById("usia_display").value = (totalBulan < 0 ? 0 : totalBulan) + " Bulan";
        document.getElementById("usia_input").value = (totalBulan < 0 ? 0 : totalBulan);
    } else {
        document.getElementById("jk_display").value = '';
        document.getElementById("jk_input").value = '';
        document.getElementById("usia_display").value = '';
        document.getElementById("usia_input").value = '';
    }
}
</script>
@endsection
