@extends('layouts.dashboard')

@section('title', 'Form Data Petugas')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #FF782D; font-weight: 700;">Form Data Petugas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Data Pengguna</a></li>
                <li class="breadcrumb-item active">Tambah Petugas</li>
            </ol>
        </nav>
    </div>

    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card shadow-sm border-0" style="border-radius: 20px;">
            <div class="card-body p-4">
              <h5 class="card-title mb-4" style="color: #2c3e50; font-weight: 600;">Tambah Petugas Baru</h5>

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="alert d-flex align-items-center border-0 shadow-sm mb-4" role="alert" style="background-color: #fff5f0; color: #FF782D; border-radius: 12px;">
                        <i class="bi bi-info-circle-fill me-2" style="font-size: 1.2rem;"></i>
                        <div>
                            Password otomatis diatur: <strong>12345678</strong>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="nama" class="col-sm-3 col-form-label fw-semibold">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 custom-input" name="nama" placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="no_hp" class="col-sm-3 col-form-label fw-semibold">Nomor WhatsApp</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-whatsapp text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 custom-input" name="no_hp" placeholder="Contoh: 08123456789" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="email" class="col-sm-3 col-form-label fw-semibold">Email Aktif</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" class="form-control border-start-0 custom-input" name="email" placeholder="email@contoh.com" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="role" class="col-sm-3 col-form-label fw-semibold">Hak Akses</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-shield-lock text-muted"></i></span>
                                <select name="role" class="form-select border-start-0 custom-input" required>
                                    <option value="" selected disabled>-- Pilih Role --</option>
                                    <option value="admin">Administrator</option>
                                    <option value="petugas">Petugas Lapangan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="row">
                        <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                            <button type="submit" class="btn btn-orange px-4 py-2" style="background-color: #FF782D; color: white; border: none; border-radius: 10px; font-weight: 600;">
                                <i class="bi bi-check-lg me-1"></i> Simpan Data
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-light px-4 py-2" style="border-radius: 10px; font-weight: 500;">
                                Batal
                            </a>
                        </div>
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

    .input-group-text {
        border-radius: 10px 0 0 10px !important;
    }

    .custom-input {
        border-radius: 0 10px 10px 0 !important;
    }

    .form-select {
        cursor: pointer;
    }
</style>

@endsection
