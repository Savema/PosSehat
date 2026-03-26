@extends('layouts.dashboard')

@section('title', 'Edit Data Ibu Hamil')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Edit Data Ibu Hamil</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Data Ibu Hamil</h5>

              <!-- General Form Elements -->
              <form action="{{ route('ibu_hamil.update', $ibu_hamil->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                  <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nik" value="{{ $ibu_hamil->nik }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" value="{{ $ibu_hamil->nama }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tgl_lahir" value="{{ $ibu_hamil->tgl_lahir }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" value="{{ $ibu_hamil->alamat }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="no_hp" class="col-sm-2 col-form-label">NO HP</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_hp" value="{{ $ibu_hamil->no_hp }}">
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

@endsection
