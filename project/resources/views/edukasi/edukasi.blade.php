@extends('layouts.dashboard')

@section('title', 'Data Edukasi')

@section('content')

    <!-- Page Title -->
    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Data Edukasi</h1>
    </div>

    <!-- Card -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Card Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Daftar Edukasi</h5>

                <a href="{{ route('edukasi.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data Edukasi
                </a>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle datatable">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Konten</th>
                            {{-- <th>Gambar</th> --}}
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($t_edukasi as $index => $t_edukasis)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $t_edukasis->kategori }}</td>
                                <td>{{ $t_edukasis->judul }}</td>
                                <td>{{ $t_edukasis->konten }}</td>
                                {{-- <td>
                                     @if($t_edukasis->gambar)
                                        <img src="{{ asset('storage/'.$t_edukasis->gambar) }}" width="100">
                                    @else
                                        Tidak ada gambar
                                    @endif
                                </td> --}}
                                <td class="text-center">

                                    <!-- Edit -->
                                    <a href="{{ route('edukasi.edit', $t_edukasis->id) }}"
                                    class="btn btn-sm btn-warning me-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('edukasi.destroy', $t_edukasis->id) }}"
                                        method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data?')"
                                                title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Belum ada data edukasi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
