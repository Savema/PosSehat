@extends('layouts.dashboard')

@section('title', 'Form Data Edukasi')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Form Data Edukasi</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Edukasi</h5>

              <!-- General Form Elements -->
              <form action="{{ route('edukasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                  <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select name="kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Resiko Tinggi Stunting">Resiko Stunting Rendah</option>
                        <option value="Stunting">Stunting</option>
                        <option value="Normal">Normal</option>
                        <option value="Resiko Gizi Lebih">Resiko Gizi Lebih</option>

                        <option value="ibu hamil gizi kurang">Ibu Hamil Gizi Kurang</option>
                        <option value="ibu hamil gizi normal">Ibu Hamil Gizi Normal</option>
                        <option value="ibu hamil gizi lebih">Ibu Hamil Gizi Lebih</option>
                        <option value="ibu hamil obesitas">Ibu Hamil Obesitas</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="judul" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="konten" class="col-sm-2 col-form-label">Konten</label>
                  <div class="col-sm-10">
                    <textarea name="konten" class="form-control" cols="80" rows="8"></textarea>
                    {{-- <input type="text-area" class="form-control" name="konten" required> --}}
                  </div>
                </div>

                {{-- <div class="row mb-3">
                  <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="gambar" required>
                  </div>
                </div> --}}

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
