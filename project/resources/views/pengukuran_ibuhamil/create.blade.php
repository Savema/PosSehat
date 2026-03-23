@extends('layouts.dashboard')

@section('title', 'Pengukuran Ibu Hamil')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Form Pengukuran Ibu Hamil</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Pengukuran</h5>

              <!-- General Form Elements -->
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
                  <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tanggal" required>
                  </div>
                </div>

                <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <select name="ibu_hamil_id" id="ibu_id" class="form-control select2" required>
                            <option value="">-- Pilih Ibu Hamil --</option>

                            @foreach($ibu_hamil as $ibu)
                            <option value="{{ $ibu->id }}" data-tgl="{{ $ibu->tgl_lahir }}">
                            {{ $ibu->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Usia</label>
                    <div class="col-sm-10">
                    <input type="text" id="usia" name="usia" class="form-control" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="berat_badan" class="col-sm-2 col-form-label">Berat Badan</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="berat_badan" required placeholder="kg">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="tinggi_badan" class="col-sm-2 col-form-label">Tinggi Badan</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="tinggi_badan" required placeholder="cm">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="lila" class="col-sm-2 col-form-label">Lila</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="lila" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="usia_kehamilan" class="col-sm-2 col-form-label">Usia Kehamilan</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="usia_kehamilan" required placeholder="minggu">
                  </div>
                </div>

                 <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->
            </div>
          </div>
        </div>
      </div>
    </section>

<script>
document.getElementById("ibu_id").addEventListener("change", function() {

    let selected = this.options[this.selectedIndex];
    let tgl_lahir = selected.getAttribute("data-tgl");

    if(tgl_lahir){

        let lahir = new Date(tgl_lahir);
        let today = new Date();

        let usia = today.getFullYear() - lahir.getFullYear();
        let m = today.getMonth() - lahir.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < lahir.getDate())) {
            usia--;
        }

        document.getElementById("usia").value = usia;
    }

});
</script>
@endsection
