@extends('layouts.dashboard')

@section('title', 'Data Pengukuran Balita')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #FF782D; font-weight: 700;">Data Pengukuran Balita</h1>
        <p class="text-muted">Pantau hasil pertumbuhan dan status gizi balita secara berkala.</p>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 20px;">
        <div class="card-body p-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                <h5 class="card-title mb-0" style="color: #2c3e50; font-weight: 600;">Riwayat Pengukuran</h5>

                <div class="mt-3 mt-md-0">
                    <a href="{{ route('pengukuran_balita.create') }}" class="btn btn-orange px-4 py-2 shadow-sm" style="background-color: #FF782D; color: white; border-radius: 10px; font-weight: 500;">
                        <i class="bi bi-plus-circle me-2"></i> Tambah Pengukuran
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('pengukuran_balita.index') }}" class="mb-4">
                <div class="input-group search-bar" style="max-width: 400px;">
                    <span class="input-group-text bg-white border-end-0" style="border-radius: 10px 0 0 10px;">
                        <i class="bi bi-search" style="color: #FF782D;"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 custom-input" id="search"
                        placeholder="Cari nama balita..."
                        value="{{ request('search') }}" style="border-radius: 0 10px 10px 0;">
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle custom-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Petugas</th>
                            <th>Tanggal</th>
                            <th>Nama Balita</th>
                            <th>Detail Fisik (BB/TB/LK)</th>
                            <th class="text-center">Hasil</th>
                            <th class="text-center">Z-Score</th>
                            <th style="width: 10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pengukuran-balita-table">
                        @forelse ($p_balita as $index => $balita)
                            <tr>
                                <td class="fw-bold text-muted">{{ $p_balita->firstItem() + $index }}</td>
                                <td><span class="small">{{ $balita->petugas->nama ?? '-' }}</span></td>
                                <td>
                                    <div class="small fw-semibold text-dark">{{ \Carbon\Carbon::parse($balita->tanggal)->translatedFormat('d M Y') }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $balita->balita->nama ?? '-' }}</div>
                                    <div class="badge bg-light text-muted fw-normal" style="font-size: 10px;">
                                        {{ \Carbon\Carbon::parse($balita->balita->tgl_lahir)->diffInMonths(\Carbon\Carbon::parse($balita->tanggal)) }} Bulan
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <span class="badge bg-blue-soft text-primary me-1">BB: {{ $balita->berat_badan }}kg</span>
                                        <span class="badge bg-green-soft text-success me-1">TB: {{ $balita->tinggi_badan }}cm</span>
                                        <span class="badge bg-purple-soft text-purple">LK: {{ $balita->lingkar_kepala }}cm</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusClass = match(strtolower($balita->hasil)) {
                                            'normal' => 'bg-success',
                                            'pendek', 'stunting' => 'bg-warning text-dark',
                                            'sangat pendek' => 'bg-danger',
                                            default => 'bg-warning'
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }} px-3 py-2" style="border-radius: 8px;">
                                        {{ $balita->hasil }}
                                    </span>
                                </td>
                                <td class="text-center fw-bold text-secondary">{{ $balita->zs_tbu }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('pengukuran_balita.detail', $balita->id) }}" class="btn btn-sm btn-detail-custom" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('pengukuran_balita.destroy', $balita->id) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-delete-custom" onclick="return confirm('Hapus data ini?')" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="bi bi-clipboard-x d-block mb-2" style="font-size: 3rem; color: #dee2e6;"></i>
                                    Belum ada data pengukuran ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <small class="text-muted">Menampilkan {{ $p_balita->firstItem() ?? 0 }} sampai {{ $p_balita->lastItem() ?? 0 }} dari {{ $p_balita->total() }} data</small>
                <div>
                    {{ $p_balita->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </div>

<style>
    .custom-table th { color: #7a7a7a; font-weight: 600; text-transform: uppercase; font-size: 11px; padding: 15px; border: none; }
    .custom-table td { padding: 15px; border-bottom: 1px solid #f8f9fa; }

    /* Soft Badges for BB/TB/LK */
    .bg-blue-soft { background-color: #e7f3ff; color: #007bff; }
    .bg-green-soft { background-color: #eafff1; color: #28a745; }
    .bg-purple-soft { background-color: #f3e8ff; color: #6f42c1; }
    .text-purple { color: #6f42c1; }

    /* Action Buttons */
    .btn-detail-custom { background-color: #e7f3ff; color: #007bff; border: none; border-radius: 8px; }
    .btn-detail-custom:hover { background-color: #007bff; color: white; }
    .btn-delete-custom { background-color: #fff5f5; color: #fa5252; border: none; border-radius: 8px; }
    .btn-delete-custom:hover { background-color: #fa5252; color: white; }
</style>

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
