@extends('layouts.dashboard')

@section('title', 'Form Data Ibu hamil')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Form Data Ibu Hamil</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-18">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Ibu Hamil</h5>

              <!-- General Form Elements -->
              <form action="{{ route('ibu_hamil.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                  <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nik" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Ibu Hamil</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" id="nama" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tgl_lahir" required>
                  </div>
                </div>

                  <div class="row mb-3">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" required>
                  </div>
                </div>

                  <div class="row mb-3">
                  <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="no_hp" required>
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

@endsection
