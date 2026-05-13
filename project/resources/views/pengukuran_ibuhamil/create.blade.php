@extends('layouts.dashboard')

@section('title', 'Form Pengukuran Ibu Hamil')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #FF782D; font-weight: 700;">Form Pengukuran Ibu Hamil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pengukuran_ibu_hamil.index') }}">Data Pengukuran</a></li>
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
                      <i class="bi bi-droplet-half" style="color: #FF782D; font-size: 1.5rem;"></i>
                  </div>
                  <h5 class="card-title mb-0" style="color: #2c3e50; font-weight: 600;">Input Pemeriksaan Ibu Hamil</h5>
              </div>

                @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

              <form action="{{ route('pengukuran_ibu_hamil.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Periksa</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar-check text-muted"></i></span>
                            <input type="date" class="form-control border-start-0 custom-input" name="tanggal" id="tanggal_ukur" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Ibu Hamil</label>
                        <select name="ibu_hamil_id" id="ibu_id" class="form-select custom-input" required>
                            <option value="" selected disabled></option>
                            @foreach($ibu_hamil as $ibu)
                                <option value="{{ $ibu->id }}"
                                    data-tgl="{{ $ibu->tgl_lahir }}">
                                    {{ $ibu->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-muted">Usia Ibu (Tahun)</label>
                        <input type="text" id="usia" name="usia" class="form-control bg-light border-0 px-3" readonly placeholder="Otomatis terisi" style="border-radius: 10px;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Usia Kehamilan (Minggu)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-clock-history text-muted"></i></span>
                            <input type="number" class="form-control border-start-0 custom-input" name="usia_kehamilan" required placeholder="Contoh: 12">
                            <span class="input-group-text bg-light border-start-0 text-muted">Minggu</span>
                        </div>
                    </div>

                    <div class="col-12"><hr class="my-4 opacity-25"></div>

                        {{-- Berat Badan --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Berat Badan</label>
                            <div class="input-group">
                                <input type="number"
                                    step="any"
                                    min="0"
                                    class="form-control custom-input fs-5 fw-bold text-center"
                                    name="berat_badan"
                                    required
                                    placeholder="0.0"
                                    min="0">
                                <span class="input-group-text bg-light border-start-0 text-muted">kg</span>
                            </div>
                        </div>

                        {{-- Tinggi Badan --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Tinggi Badan</label>
                            <div class="input-group">
                                <input type="number"
                                    step="any"
                                    min="0"
                                    class="form-control custom-input fs-5 fw-bold text-center"
                                    name="tinggi_badan"
                                    required
                                    placeholder="0.0"
                                    min="0">
                                <span class="input-group-text bg-light border-start-0 text-muted">cm</span>
                            </div>
                        </div>

                        {{-- LILA --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">LILA (Lingkar Lengan)</label>
                            <div class="input-group">
                                <input type="number"
                                    step="any"
                                    min="0"
                                    class="form-control custom-input fs-5 fw-bold text-center"
                                    name="lila"
                                    required
                                    placeholder="0.0"
                                    min="0">
                                <span class="input-group-text bg-light border-start-0 text-muted">cm</span>
                            </div>
                        </div>

                <div class="d-flex justify-content-end gap-2 border-top mt-4 pt-4">
                    <a href="{{ route('pengukuran_ibu_hamil.index') }}" class="btn btn-light px-4" style="border-radius: 10px;">Batal</a>
                    <button type="submit" class="btn btn-orange px-4 py-2" style="background-color: #FF782D; color: white; border-radius: 10px; font-weight: 600; border: none;">
                        <i class="bi bi-save me-2"></i>Simpan Data Pengukuran
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
    /* Style untuk baris BB/TB/LILA */
    .col-md-4 .custom-input { border-radius: 10px 0 0 10px !important; }
    .col-md-4 .input-group-text { border-radius: 0 10px 10px 0; }
</style>

<script>
$(document).ready(function() {
    // Inisialisasi Select2
    $('#ibu_id').select2({
        placeholder: 'Cari nama ibu hamil...',
        allowClear: true,
        width: '100%'
    });

    // Event change Select2
    $('#ibu_id').on('change', function() {
        let selected = document.getElementById("ibu_id");
        let opt = selected.options[selected.selectedIndex];
        let tgl_lahir = opt.getAttribute("data-tgl");

        if (tgl_lahir) {
            let lahir = new Date(tgl_lahir);
            let today = new Date();
            let usia = today.getFullYear() - lahir.getFullYear();
            let m = today.getMonth() - lahir.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < lahir.getDate())) {
                usia--;
            }
            document.getElementById("usia").value = usia + " Tahun";
        } else {
            document.getElementById("usia").value = '';
        }
    });
});
</script>
@endsection
