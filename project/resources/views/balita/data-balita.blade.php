@extends('layouts.dashboard')

@section('title', 'Data Balita')

@section('content')

    <!-- Page Title -->
    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Data Balita</h1>
    </div>

    <!-- Card -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Card Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Daftar Balita</h5>

                <a href="{{ route('balita.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data Balita
                </a>
            </div>

            <form method="GET" action="{{ route('balita.index') }}" class="mb-3">
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
                            <th>Nama Balita</th>
                            <th class="text-center">Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Orang Tua</th>
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="balita-table">
                        @forelse ($balita as $index => $balitas)
                            <tr>
                                <td>{{ $balita->firstItem() + $index }}</td>
                                <td>{{ $balitas->nama }}</td>
                                <td>{{ $balitas->alamat }}</td>
                                <td>{{ $balitas->tgl_lahir }}</td>
                                <td>
                                    <span class="">
                                        {{ $balitas->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </td>
                                <td>{{ $balitas->nama_ortu }}</td>
                                <td class="text-center">

                                    <!-- Edit -->
                                    <a href="{{ route('balita.edit', $balitas->id) }}"
                                    class="btn btn-sm btn-warning me-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('balita.destroy', $balitas->id) }}"
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
                                    Belum ada data balita
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $balita->withQueryString()->links() }}
            </div>

        </div>
    </div>

<script>
let delayTimer;

document.getElementById('search').addEventListener('keyup', function () {
    clearTimeout(delayTimer);

    let query = this.value;

    delayTimer = setTimeout(() => {
        fetch(`{{ route('balita.index') }}?search=` + query)
        .then(response => response.text())
        .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');

            let newTable = doc.querySelector('#balita-table').innerHTML;
            document.getElementById('balita-table').innerHTML = newTable;
        });
    }, 300);
});
</script>

@endsection
