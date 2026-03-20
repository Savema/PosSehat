@extends('layouts.dashboard')

@section('title', 'Edit Data Balita')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Edit Data Balita</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Data Balita</h5>

              <!-- General Form Elements -->
              <form action="{{ route('balita.update', $balita->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                  <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nik" value="{{ $balita->nik }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Balita</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" value="{{ $balita->nama }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                    <select name="jenis_kelamin" class="form-control">
                        <option value="1" {{ $balita->jenis_kelamin == 1 ? 'selected' : '' }}>
                            Laki-laki
                        </option>

                        <option value="0" {{ $balita->jenis_kelamin == 0 ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tgl_lahir" value="{{ $balita->tgl_lahir }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama_ortu" class="col-sm-2 col-form-label">Nama Ortu</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_ortu" value="{{ $balita->nama_ortu }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" value="{{ $balita->alamat }}">
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
