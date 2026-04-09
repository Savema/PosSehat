@extends('layouts.dashboard')

@section('title', 'Data Balita')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #FF782D; font-weight: 700;">Data Balita</h1>
        <p class="text-muted">Manajemen data balita PosSehat.</p>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 20px;">
        <div class="card-body p-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                <div>
                    <h5 class="card-title mb-0" style="color: #2c3e50; font-weight: 600;">Daftar Balita</h5>
                </div>

                <div class="mt-3 mt-md-0">
                    <a href="{{ route('balita.create') }}" class="btn btn-orange px-4 py-2 shadow-sm" style="background-color: #FF782D; color: white; border-radius: 10px; font-weight: 500;">
                        <i class="bi bi-plus-circle me-2"></i> Tambah Balita
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('balita.index') }}" class="mb-4">
                <div class="input-group search-bar" style="max-width: 400px;">
                    <span class="input-group-text bg-white border-end-0" style="border-radius: 10px 0 0 10px;">
                        <i class="bi bi-search" style="color: #FF782D;"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0" id="search"
                        placeholder="Cari nama balita..."
                        value="{{ request('search') }}" style="border-radius: 0 10px 10px 0;">
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle custom-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>NIK</th>
                            <th>Nama Balita</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Orang Tua</th>
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="balita-table">
                        @forelse ($balita as $index => $balitas)
                            <tr>
                                <td class="fw-bold">{{ $balita->firstItem() + $index }}</td>
                                <td>{{ $balitas->nik }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($balitas->nama) }}&background=fff5f0&color=FF782D" class="rounded-circle" width="35">
                                        </div>
                                        <span class="fw-semibold text-dark">{{ $balitas->nama }}</span>
                                    </div>
                                </td>
                                <td>{{ $balitas->tgl_lahir }}</td>
                                <td>{{ $balitas->alamat }}</td>
                                <td>
                                    @if($balitas->jenis_kelamin == 1)
                                        <span class="badge bg-blue-light">
                                            <i class="bi bi-gender-male me-1"></i> Laki-laki
                                        </span>
                                    @else
                                        <span class="badge bg-pink-light">
                                            <i class="bi bi-gender-female me-1"></i> Perempuan
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $balitas->nama_ortu }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('balita.edit', $balitas->id) }}"
                                        class="btn btn-sm btn-edit-custom" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('balita.destroy', $balitas->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-delete-custom"
                                                    onclick="return confirm('Yakin ingin menghapus data balita ini?')"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-person-x d-block mb-2" style="font-size: 3rem; color: #dee2e6;"></i>
                                    Belum ada data balita yang ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <small class="text-muted">Menampilkan {{ $balita->firstItem() ?? 0 }} sampai {{ $balita->lastItem() ?? 0 }} dari {{ $balita->total() }} data</small>
                <div>
                    {{ $balita->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </div>

<style>
    /* Table Styling */
    .custom-table thead {
        background-color: #f8f9fa;
    }
    .custom-table th {
        color: #7a7a7a;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border-top: none;
        padding: 15px;
    }
    .custom-table td {
        padding: 15px;
        color: #555;
    }

    /* Badge Styling */
    .bg-orange-light {
        background-color: #fff5f0;
        color: #FF782D;
        border: 1px solid #ffccbc;
    }
    .bg-blue-light {
        background-color: #e3f2fd;
        color: #1976d2;
        border: 1px solid #bbdefb;
    }

    /* Action Buttons */
    .btn-edit-custom {
        background-color: #fff9db;
        color: #f59f00;
        border: none;
    }
    .btn-edit-custom:hover {
        background-color: #f59f00;
        color: white;
    }
    .btn-delete-custom {
        background-color: #fff5f5;
        color: #fa5252;
        border: none;
    }
    .btn-delete-custom:hover {
        background-color: #fa5252;
        color: white;
    }

    /* Form Control Focus */
    .form-control:focus {
        border-color: #FF782D;
        box-shadow: 0 0 0 0.2rem rgba(255, 120, 45, 0.25);
    }
    /* Badge Laki-laki (Biru Lembut) */
    .bg-blue-light {
        background-color: #e7f3ff; /* Biru sangat muda */
        color: #007bff;            /* Teks biru */
        border: 1px solid #cfe2ff;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
    }

    /* Badge Perempuan (Merah Muda Lembut) */
    .bg-pink-light {
        background-color: #fff0f3; /* Pink sangat muda */
        color: #ff4d6d;            /* Teks pink/merah muda */
        border: 1px solid #ffccd5;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
    }

    /* Efek hover agar interaktif */
    .badge:hover {
        opacity: 0.8;
        cursor: default;
    }
</style>

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



