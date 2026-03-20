@extends('layouts.dashboard')

@section('title', 'Data Ibu Hamil')

@section('content')

    <!-- Page Title -->
    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Data Ibu Hamil</h1>
    </div>

    <!-- Card -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Card Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Daftar Ibu Hamil</h5>

                <a href="{{ route('ibu_hamil.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data Ibu Hamil
                </a>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle datatable">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ibu_hamil as $index => $ibu_hamils)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $ibu_hamils->nama }}</td>
                                <td>{{ $ibu_hamils->tgl_lahir }}</td>
                                <td>{{ $ibu_hamils->alamat }}</td>
                                <td>{{ $ibu_hamils->no_hp }}</td>
                                <td class="text-center">

                                    <!-- Edit -->
                                    <a href="{{ route('ibu_hamil.edit', $ibu_hamils->id) }}"
                                    class="btn btn-sm btn-warning me-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('ibu_hamil.destroy', $ibu_hamils->id) }}"
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
                                    Belum ada data ibu hamil
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
