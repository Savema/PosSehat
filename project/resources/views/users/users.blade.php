@extends('layouts.dashboard')

@section('title', 'Data Pengguna')

@section('content')

    <!-- Page Title -->
    <div class="pagetitle mb-4">
        <h1 style="color: #9c3a5b;">Data Pengguna</h1>
    </div>

    <!-- Card -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Card Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Daftar Pengguna</h5>

                <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data Petugas
                </a>
            </div>

            <form method="GET" action="{{ route('users.index') }}" class="mb-3">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" name="search" class="form-control" id="search"
                        placeholder="Cari nama, email, no HP..."
                        value="{{ request('search') }}">

                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="user-table">
                        @forelse ($user as $index => $users)
                            <tr>
                                <td>{{ $user->firstItem() + $index }}</td>
                                <td>{{ $users->nama }}</td>
                                <td>{{ $users->no_hp }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->role }}</td>
                                <td class="text-center">

                                    <!-- Edit -->
                                    <a href="{{ route('users.edit', $users->id) }}"
                                    class="btn btn-sm btn-warning me-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('users.destroy', $users->id) }}"
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
                                    Belum ada data petugas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $user->withQueryString()->links() }}
            </div>

        </div>
    </div>

<script>
let delayTimer;

document.getElementById('search').addEventListener('keyup', function () {
    clearTimeout(delayTimer);

    let query = this.value;

    delayTimer = setTimeout(() => {
        fetch(`{{ route('users.index') }}?search=` + query)
        .then(response => response.text())
        .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');

            let newTable = doc.querySelector('#user-table').innerHTML;
            document.getElementById('user-table').innerHTML = newTable;
        });
    }, 300);
});
</script>

@endsection
