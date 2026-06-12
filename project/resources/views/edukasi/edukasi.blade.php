@extends('layouts.dashboard')

@section('title', 'Data Edukasi')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #FF782D; font-weight: 700;">Data Edukasi</h1>
        <p class="text-muted">Kelola konten informasi dan tips kesehatan untuk pengguna PosSehat.</p>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 20px;">
        <div class="card-body p-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                <h5 class="card-title mb-0" style="color: #2c3e50; font-weight: 600;">Daftar Konten Edukasi</h5>

                <div class="mt-3 mt-md-0">
                    <a href="{{ route('edukasi.create') }}" class="btn btn-orange px-4 py-2 shadow-sm" style="background-color: #FF782D; color: white; border-radius: 10px; font-weight: 500;">
                        <i class="bi bi-plus-circle me-2"></i> Tambah Edukasi
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('edukasi.index') }}" class="mb-4">
                <div class="input-group search-bar" style="max-width: 400px;">
                    <span class="input-group-text bg-white border-end-0" style="border-radius: 10px 0 0 10px;">
                        <i class="bi bi-search" style="color: #FF782D;"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0" id="search"
                        placeholder="Cari kategori edukasi..."
                        value="{{ request('search') }}" style="border-radius: 0 10px 10px 0;">
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle custom-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 15%">Kategori</th>
                            <th style="width: 25%">Judul</th>
                            <th style="width: 40%">Ringkasan Konten</th>
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="edukasi-table">
                        @forelse ($t_edukasi as $index => $item)
                            <tr>
                                <td class="fw-bold">{{ $t_edukasi->firstItem() + $index }}</td>
                                <td>
                                    <span class="badge {{ strtolower($item->kategori) == 'Sangat Pendek' ? 'bg-danger-light' : 'bg-orange-light' }}">
                                        {{ $item->kategori }}
                                    </span>
                                </td>
                                <td><span class="fw-semibold text-dark">{{ $item->judul }}</span></td>
                                <td class="text-muted small">
                                    {{ Str::limit($item->konten, 80, '...') }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('edukasi.edit', $item->id) }}"
                                        class="btn btn-sm btn-edit-custom" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('edukasi.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-delete-custom"
                                                    onclick="return confirm('Yakin ingin menghapus edukasi ini?')"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-journal-x d-block mb-2" style="font-size: 3rem; color: #dee2e6;"></i>
                                    Belum ada data edukasi ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 px-2">
                <div class="mb-3 mb-md-0">
                    <p class="text-muted small mb-0">
                        Menampilkan <span class="fw-bold text-dark">{{ $t_edukasi->firstItem() ?? 0 }}</span>
                        sampai <span class="fw-bold text-dark">{{ $t_edukasi->lastItem() ?? 0 }}</span>
                        dari <span class="fw-bold text-dark">{{ $t_edukasi->total() }}</span> data
                    </p>
                </div>
                <div class="pagination-orange">
                    {{ $t_edukasi->links() }}
                </div>
            </div>
        </div>
    </div>

<style>
    .custom-table thead { background-color: #f8f9fa; }
    .custom-table th { color: #7a7a7a; font-weight: 600; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; padding: 15px; border: none; }
    .custom-table td { padding: 15px; border-bottom: 1px solid #f1f1f1; }

    /* Badge Warna Oranye & Merah Soft */
    .bg-orange-light { background-color: #fff5f0; color: #FF782D; border: 1px solid #ffccbc; border-radius: 6px; }
    .bg-danger-light { background-color: #fff5f5; color: #fa5252; border: 1px solid #ffc9c9; border-radius: 6px; }

    /* Button Action */
    .btn-edit-custom { background-color: #fff9db; color: #f59f00; border: none; border-radius: 8px; }
    .btn-edit-custom:hover { background-color: #f59f00; color: white; }
    .btn-delete-custom { background-color: #fff5f5; color: #fa5252; border: none; border-radius: 8px; }
    .btn-delete-custom:hover { background-color: #fa5252; color: white; }
    .pagination-orange .pagination {
        gap: 5px;
    }
    .pagination-orange .page-link {
        border-radius: 8px !important;
        color: #FF782D !important;
        border: 1px solid #eee !important;
    }
    .pagination-orange .page-item.active .page-link {
        background-color: #FF782D !important;
        border-color: #FF782D !important;
        color: white !important;
    }
    .pagination-orange nav .flex.items-center.justify-between .hidden.sm-flex-1 {
        display: none !important;
    }

    /* Jika masih ada teks 'Showing' di versi mobile */
    .pagination-orange nav div:first-child p {
        display: none !important;
    }

    /* Memastikan tombol angka tetap rapi */
    .pagination-orange .pagination {
        margin-bottom: 0;
    }
</style>


<script>
let delayTimer;

document.getElementById('search').addEventListener('keyup', function () {
    clearTimeout(delayTimer);

    let query = this.value;

    delayTimer = setTimeout(() => {
        fetch(`{{ route('edukasi.index') }}?search=` + query)
        .then(response => response.text())
        .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');

            let newTable = doc.querySelector('#edukasi-table').innerHTML;
            document.getElementById('edukasi-table').innerHTML = newTable;
        });
    }, 300);
});
</script>

@endsection
