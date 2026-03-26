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

            <form method="GET" action="{{ route('pengukuran_balita.index') }}" class="mb-3">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" name="search" class="form-control" id="search"
                        placeholder="Cari nama..."
                        value="{{ request('search') }}">

                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>

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
                    <tbody id="pengukuran-balita-table">
                        @forelse ($p_balita as $index => $balita)
                            <tr>
                                <td>{{ $p_balita->firstItem() + $index }}</td>
                                <td>{{ $balita->petugas->nama ?? '-' }}</td>
                                <td>{{ $balita->tanggal }}</td>
                                <td>{{ $balita->balita->nama ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($balita->balita->tgl_lahir)->diffInMonths(\Carbon\Carbon::parse($balita->tanggal)) }} Bulan</td>
                                <td>{{ $balita->berat_badan }}</td>
                                <td>{{ $balita->tinggi_badan }}</td>
                                <td>{{ $balita->lingkar_kepala }}</td>
                                <td>{{ $balita->hasil }}</td>
                                <td>{{ $balita->zs_tbu }}</td>
                                <td class="text-center">
                                    <!-- Detail -->
                                    <a href="{{ route('pengukuran_balita.detail', $balita->id) }}"
                                        class="btn btn-sm btn-info"
                                        title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('pengukuran_balita.destroy', $balita->id) }}"
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
                                <td colspan="12" class="text-center text-muted">
                                    Belum ada data pengukuran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $p_balita->withQueryString()->links() }}
            </div>

        </div>
    </div>

<script>
let delayTimer;

document.getElementById('search').addEventListener('keyup', function () {
    clearTimeout(delayTimer);

    let query = this.value;

    delayTimer = setTimeout(() => {
        fetch(`{{ route('pengukuran_balita.index') }}?search=` + query)
        .then(response => response.text())
        .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');

            let newTable = doc.querySelector('#pengukuran-balita-table').innerHTML;
            document.getElementById('pengukuran-balita-table').innerHTML = newTable;
        });
    }, 300);
});
</script>
@endsection
