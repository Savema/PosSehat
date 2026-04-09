@extends('layouts.dashboard')

@section('title', 'Edit Data Petugas')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #FF782D; font-weight: 700;">Edit Data Petugas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Data Pengguna</a></li>
                <li class="breadcrumb-item active">Edit Petugas</li>
            </ol>
        </nav>
    </div>

    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card shadow-sm border-0" style="border-radius: 20px;">
            <div class="card-body p-4">
              <h5 class="card-title mb-4" style="color: #2c3e50; font-weight: 600;">Perbarui Informasi Petugas</h5>

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        <label for="nama" class="col-sm-3 col-form-label fw-semibold">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 custom-input" name="nama" value="{{ old('nama', $user->nama) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="no_hp" class="col-sm-3 col-form-label fw-semibold">Nomor WhatsApp</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-whatsapp text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 custom-input" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="email" class="col-sm-3 col-form-label fw-semibold">Email Aktif</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" class="form-control border-start-0 custom-input" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="password" class="col-sm-3 col-form-label fw-semibold">Password Baru</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-lock text-muted"></i></span>
                                <input type="password" class="form-control border-start-0 custom-input" name="password" id="passwordField" placeholder="Isi hanya jika ingin ganti password">
                                <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword" style="border-radius: 0 10px 10px 0; border-color: #dee2e6;">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="form-text mt-2 text-muted" style="font-size: 0.85rem;">
                                <i class="bi bi-info-circle me-1"></i> Kosongkan jika tidak ingin mengubah password petugas.
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4 mt-4">
                        <label for="role" class="col-sm-3 col-form-label fw-semibold">Hak Akses</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-shield-lock text-muted"></i></span>
                                <select name="role" class="form-select border-start-0 custom-input" required>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                                    <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas Lapangan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="row">
                        <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                            <button type="submit" class="btn btn-orange px-4 py-2" style="background-color: #FF782D; color: white; border: none; border-radius: 10px; font-weight: 600;">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
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

<script>
    // Fitur Show/Hide Password
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#passwordField');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('bi-eye');
        this.querySelector('i').classList.toggle('bi-eye-slash');
    });
</script>

<style>
    .custom-input:focus {
        border-color: #FF782D !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 120, 45, 0.1) !important;
    }
    .input-group-text { border-radius: 10px 0 0 10px !important; }
    .custom-input { border-radius: 0 10px 10px 0 !important; }
    #passwordField { border-radius: 0 !important; } /* Khusus field password karena ada tombol eye */
</style>

@endsection
