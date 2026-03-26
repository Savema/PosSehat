@extends('layouts.dashboard')

@section('title', 'Form Data Petugas')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Form Data Petugas</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-18">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Petugas</h5>

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="alert alert-info border-light shadow-sm" role="alert">
                        <i class="bi bi-info-circle me-1"></i>
                        Password petugas baru akan otomatis diatur menjadi: <strong>12345678</strong>
                    </div>

                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_hp" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select name="role" class="form-control" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary" style="background-color: #9c3a5b; border: none;">Simpan Petugas</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>

            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
