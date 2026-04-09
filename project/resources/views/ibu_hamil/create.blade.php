@extends('layouts.dashboard')

@section('title', 'Form Data Ibu Hamil')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #FF782D; font-weight: 700;">Form Data Ibu Hamil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ibu_hamil.index') }}">Data Ibu Hamil</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
        </nav>
    </div>

    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-9">

          <div class="card shadow-sm border-0" style="border-radius: 20px;">
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-4">
                  <div class="icon-box me-3" style="background: #fff5f0; padding: 10px; border-radius: 12px;">
                      <i class="bi bi-person-heart" style="color: #FF782D; font-size: 1.5rem;"></i>
                  </div>
                  <h5 class="card-title mb-0" style="color: #2c3e50; font-weight: 600;">Registrasi Ibu Hamil Baru</h5>
              </div>

              <form action="{{ route('ibu_hamil.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">NIK</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-card-text text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 custom-input" name="nik" placeholder="16 digit NIK" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-person text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 custom-input" name="nama" id="nama" placeholder="Nama lengkap ibu" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar-event text-muted"></i></span>
                            <input type="date" class="form-control border-start-0 custom-input" name="tgl_lahir" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nomor WhatsApp/HP</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-whatsapp text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 custom-input" name="no_hp" placeholder="Contoh: 0812345..." required>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-geo-alt text-muted"></i></span>
                            <textarea class="form-control border-start-0 custom-input" name="alamat" rows="2" placeholder="Alamat domisili saat ini" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-4">
                    <a href="{{ route('ibu_hamil.index') }}" class="btn btn-light px-4" style="border-radius: 10px;">Batal</a>
                    <button type="submit" class="btn btn-orange px-4" style="background-color: #FF782D; color: white; border-radius: 10px; font-weight: 600; border: none;">
                        <i class="bi bi-save me-2"></i>Simpan Data Ibu Hamil
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
    .input-group-text { border-radius: 10px 0 0 10px !important; }
    .custom-input { border-radius: 0 10px 10px 0 !important; }
</style>

@endsection
