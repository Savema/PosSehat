@extends('layouts.dashboard')

@section('title', 'Edit Data Edukasi')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Edit Data Edukasi</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Data Edukasi</h5>

              <!-- General Form Elements -->
              <form action="{{ route('edukasi.update', $t_edukasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">

                    <select name="kategori" class="form-control">

                    <option value="Resiko Tinggi Stunting"
                    {{ $t_edukasi->kategori == 'Resiko Tinggi Stunting' ? 'selected' : '' }}>
                    Resiko Tinggi Stunting
                    </option>

                    <option value="Stunting"
                    {{ $t_edukasi->kategori == 'Stunting' ? 'selected' : '' }}>
                    Stunting
                    </option>

                    <option value="Normal"
                    {{ $t_edukasi->kategori == 'Normal' ? 'selected' : '' }}>
                    Normal
                    </option>

                    <option value="Resiko Gizi Lebih"
                    {{ $t_edukasi->kategori == 'Resiko Gizi Lebih' ? 'selected' : '' }}>
                    Resiko Gizi Lebih
                    </option>

                    <option value="ibu hamil gizi kurang"
                    {{ $t_edukasi->kategori == 'ibu hamil gizi kurang' ? 'selected' : '' }}>
                    Ibu Hamil Gizi Kurang
                    </option>

                    <option value="ibu hamil gizi normal"
                    {{ $t_edukasi->kategori == 'ibu hamil gizi normal' ? 'selected' : '' }}>
                    Ibu Hamil Gizi Normal
                    </option>

                    <option value="ibu hamil gizi lebih"
                    {{ $t_edukasi->kategori == 'ibu hamil gizi lebih' ? 'selected' : '' }}>
                    Ibu Hamil Gizi Lebih
                    </option>

                    <option value="ibu hamil obesitas"
                    {{ $t_edukasi->kategori == 'ibu hamil obesitas' ? 'selected' : '' }}>
                    Ibu Hamil Obesitas
                    </option>
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="judul" value="{{ $t_edukasi->judul }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="konten" class="col-sm-2 col-form-label">Konten</label>
                  <div class="col-sm-10">
                    <textarea name="konten" class="form-control" cols="80" rows="8" value="" >{{ $t_edukasi->konten }}</textarea>
                    {{-- <input type="text-area" class="form-control" name="konten" value="{{ $t_edukasi->konten }}"> --}}
                  </div>
                </div>

                {{-- <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">

                    @if($t_edukasi->gambar)
                    <img src="{{ asset('storage/'.$t_edukasi->gambar) }}" width="120" class="mb-2">
                    @endif

                    <input type="file" name="gambar" class="form-control">

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
