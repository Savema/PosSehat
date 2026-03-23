@extends('layouts.dashboard')

@section('title', 'Pengukuran Balita')

@section('content')
    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Form Pengukuran Balita</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-10">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Pengukuran</h5>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

              <form action="{{ route('pengukuran_balita.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                  <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Ukur</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tanggal" id="tanggal_ukur" value="{{ date('Y-m-d') }}" required>
                  </div>
                </div>

                <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Balita</label>
                    <div class="col-sm-10">
                        <select name="balita_id" id="balita_id" class="form-control select2" required>
                            <option value="">-- Pilih Balita --</option>
                            @foreach($balita as $b)
                                <option value="{{ $b->id }}" data-tgl="{{ $b->tgl_lahir }}" data-jk="{{ $b->jenis_kelamin }}">
                                    {{ $b->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" id="jk_display" class="form-control" readonly placeholder="Otomatis">
                        <input type="hidden" name="jenis_kelamin" id="jk_input">
                    </div>
                </div>

                <div class="row mb-3">
                <label for="usia" class="col-sm-2 col-form-label">Usia (Bulan)</label>
                    <div class="col-sm-10">
                        <input type="text" id="usia_display" class="form-control" readonly placeholder="Otomatis terisi dalam bulan">
                        <input type="hidden" name="usia" id="usia_input">
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="berat_badan" class="col-sm-2 col-form-label">Berat Badan</label>
                  <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" name="berat_badan" required placeholder="kg">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="tinggi_badan" class="col-sm-2 col-form-label">Tinggi Badan</label>
                  <div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="tinggi_badan" required placeholder="cm">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="lingkar_kepala" class="col-sm-2 col-form-label">Lingkar Kepala</label>
                  <div class="col-sm-10">
                    <input type="number" step="0.1" class="form-control" name="lingkar_kepala" required>
                  </div>
                </div>

                 <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

<script>
function updateData() {
    let sel = document.getElementById("balita_id");
    let opt = sel.options[sel.selectedIndex];

    if (opt.value) {
        // Update JK (1=Laki, 0=Perempuan)
        let jk = opt.getAttribute("data-jk");
        document.getElementById("jk_display").value = (jk == 1) ? "Laki-laki" : "Perempuan";
        document.getElementById("jk_input").value = jk;

        // Hitung Usia
        let tglLahir = new Date(opt.getAttribute("data-tgl"));
        let tglUkur = new Date(document.getElementById("tanggal_ukur").value);
        let totalBulan = (tglUkur.getFullYear() - tglLahir.getFullYear()) * 12 + (tglUkur.getMonth() - tglLahir.getMonth());
        if (tglUkur.getDate() < tglLahir.getDate()) totalBulan--;

        document.getElementById("usia_display").value = (totalBulan < 0 ? 0 : totalBulan) + " Bulan";
        document.getElementById("usia_input").value = (totalBulan < 0 ? 0 : totalBulan);
    }
}
document.getElementById("balita_id").addEventListener("change", updateData);
document.getElementById("tanggal_ukur").addEventListener("change", updateData);
</script>
@endsection
