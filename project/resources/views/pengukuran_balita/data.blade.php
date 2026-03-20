@extends('layouts.dashboard')

@section('title', 'Data Pengukuran Balta')

@section('content')

    <!-- Page Title -->
    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Data Pengukuran Balita</h1>
    </div>

    <!-- Card -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Card Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Daftar Hasil Pengukuran</h5>

                <a href="{{ route('pengukuran_balita.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Pengukuran
                </a>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle datatable">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%" >No</th>
                            <th>Petugas</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Berat Badan</th>
                            <th>Tinggi Badan</th>
                            <th>Lingkar Kepala</th>
                            <th>Hasil</th>
                            <th>Z-score TBU</th>
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($p_ibuhamil as $index => $ibu) --}}
                            <tr>
                                {{-- <td>{{ $index + 1 }}</td>
                                <td>{{ $ibu->petugas->nama ?? '-' }}</td>
                                <td>{{ $ibu->tanggal }}</td>
                                <td>{{ $ibu->ibuHamil->nama ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($ibu->ibuHamil->tgl_lahir)->age ?? '-' }}</td>
                                <td>{{ $ibu->berat_badan }}</td>
                                <td>{{ $ibu->tinggi_badan }}</td>
                                <td>{{ $ibu->lila }}</td>
                                <td class="text-center">{{ $ibu->usia_kehamilan }}</td>
                                <td>{{ $ibu->imt }}</td>
                                <td>{{ $ibu->status_gizi }}</td> --}}
                                {{-- <td class="text-center">
                                    <!-- Detail -->
                                    <a href="{{ route('pengukuran_ibu_hamil.detail', $ibu->id) }}"
                                        class="btn btn-sm btn-info"
                                        title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('pengukuran_ibu_hamil.destroy', $ibu->id) }}"
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

                                </td> --}}
                            </tr>

                        {{-- @empty --}}
                            <tr>
                                <td colspan="12" class="text-center text-muted">
                                    Belum ada data pengukuran
                                </td>
                            </tr>
                        {{-- @endforelse --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
