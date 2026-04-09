@extends('layouts.dashboard')

@section('title', 'Profil Petugas')

@section('content')
<div class="pagetitle mb-4">
    <h1 style="color: #FF782D; font-weight: 700;">Pengaturan Profil</h1>
</div>

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <div class="d-flex align-items-center justify-content-center mb-3"
                         style="width: 120px; height: 120px; background-color: #fff5f0; border: 4px solid #FF782D; border-radius: 50%;">
                        <i class="bi bi-person-fill" style="font-size: 4rem; color: #FF782D;"></i>
                    </div>

                    <h3 style="color: #2c3e50; font-weight: 700;">{{ $user->nama }}</h3>
                    <span class="badge" style="background-color: #fff5f0; color: #FF782D; border: 1px solid #FF782D; border-radius: 8px;">
                        <i class="bi bi-shield-check me-1"></i> {{ ucfirst($user->role) }}
                    </span>

                    <div class="mt-3 text-center w-100">
                        <hr class="opacity-25">
                        <p class="text-muted small mb-1"><i class="bi bi-envelope me-1"></i> {{ $user->email }}</p>
                        <p class="text-muted small"><i class="bi bi-whatsapp me-1"></i> {{ $user->no_hp }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body pt-3 p-4">
                    <h5 class="card-title" style="color: #2c3e50; font-weight: 600;">Ubah Password Keamanan</h5>
                    <p class="text-muted small mb-4">Pastikan password baru Anda kuat dan sulit ditebak.</p>

                    @if(session('success'))
                        <div class="alert border-0 shadow-sm" style="background-color: #d1e7dd; color: #0f5132; border-radius: 12px;">
                            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-md-4 col-lg-3 col-form-label fw-semibold">Password Saat Ini</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="current_password" type="password" class="form-control custom-input @error('current_password') is-invalid @enderror" id="current_password" placeholder="********">
                                @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-lg-3 col-form-label fw-semibold">Password Baru</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="password" type="password" class="form-control custom-input @error('password') is-invalid @enderror" id="newPassword" placeholder="Min. 8 karakter">
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-md-4 col-lg-3 col-form-label fw-semibold">Konfirmasi Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="password_confirmation" type="password" class="form-control custom-input" id="renewPassword" placeholder="Ulangi password baru">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-orange px-4 py-2" style="background-color: #FF782D; color: white; border: none; border-radius: 10px; font-weight: 600;">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .custom-input { border-radius: 10px !important; padding: 10px 15px; }
    .custom-input:focus { border-color: #FF782D; box-shadow: 0 0 0 0.25rem rgba(255, 120, 45, 0.1); }
</style>
@endsection
