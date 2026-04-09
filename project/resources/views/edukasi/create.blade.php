@extends('layouts.dashboard')

@section('title', 'Tambah Data Edukasi')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #FF782D; font-weight: 700;">Tambah Data Edukasi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('edukasi.index') }}">Data Edukasi</a></li>
                <li class="breadcrumb-item active">Tambah Konten</li>
            </ol>
        </nav>
    </div>

    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-10"> <div class="card shadow-sm border-0" style="border-radius: 20px;">
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-4">
                  <div class="icon-box me-3" style="background: #fff5f0; padding: 10px; border-radius: 12px;">
                      <i class="bi bi-journal-plus" style="color: #FF782D; font-size: 1.5rem;"></i>
                  </div>
                  <h5 class="card-title mb-0" style="color: #2c3e50; font-weight: 600;">Buat Konten Edukasi Baru</h5>
              </div>

              <form action="{{ route('edukasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kategori Edukasi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-tag text-muted"></i></span>
                            <select name="kategori" class="form-select border-start-0 custom-input" required>
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                <optgroup label="Kategori Balita (Stunting)">
                                    <option value="Sangat Pendek">Sangat Pendek</option>
                                    <option value="Pendek">Pendek</option>
                                    <option value="Normal">Normal</option>
                                </optgroup>
                                <optgroup label="Kategori Ibu Hamil">
                                    <option value="ibu hamil gizi kurang">Gizi Kurang</option>
                                    <option value="ibu hamil gizi normal">Gizi Normal</option>
                                    <option value="ibu hamil gizi lebih">Gizi Lebih</option>
                                    <option value="ibu hamil obesitas">Obesitas</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Judul Edukasi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-pencil text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 custom-input" name="judul" placeholder="Contoh: Tips Nutrisi Masa Kehamilan" required>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label class="form-label fw-semibold">Isi Konten / Template Pesan</label>
                        <textarea name="konten" class="form-control custom-input" rows="10" placeholder="Tuliskan materi edukasi atau template pesan edukasi di sini..." style="border-radius: 12px !important;"></textarea>
                        <div class="form-text mt-2 text-muted">
                            <i class="bi bi-info-circle me-1"></i> Konten ini akan digunakan sebagai referensi atau dikirimkan kepada pasien.
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-4">
                    <a href="{{ route('edukasi.index') }}" class="btn btn-light px-4" style="border-radius: 10px;">Batal</a>
                    <button type="submit" class="btn btn-orange px-4" style="background-color: #FF782D; color: white; border-radius: 10px; font-weight: 600; border: none;">
                        <i class="bi bi-send me-2"></i>Simpan Edukasi
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
    .form-select.custom-input { border-radius: 0 10px 10px 0 !important; }
    input.custom-input { border-radius: 0 10px 10px 0 !important; }
</style>

@endsection
