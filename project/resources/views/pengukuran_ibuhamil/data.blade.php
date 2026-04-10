@extends('layouts.dashboard')

@section('title', 'Data Pengukuran Ibu Hamil')

@section('content')

    <div class="pagetitle mb-4">
        <h1 style="color: #FF782D; font-weight: 700;">Data Pengukuran Ibu Hamil</h1>
        <p class="text-muted">Monitoring kesehatan nutrisi dan perkembangan ibu hamil secara berkala.</p>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 20px;">
        <div class="card-body p-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                <h5 class="card-title mb-0" style="color: #2c3e50; font-weight: 600;">Daftar Hasil Pengukuran</h5>

                <div class="mt-3 mt-md-0">
                    <a href="{{ route('pengukuran_ibu_hamil.create') }}" class="btn btn-orange px-4 py-2 shadow-sm" style="background-color: #FF782D; color: white; border-radius: 10px; font-weight: 500;">
                        <i class="bi bi-plus-circle me-2"></i> Tambah Pengukuran
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('pengukuran_ibu_hamil.index') }}" class="mb-4">
                <div class="input-group search-bar" style="max-width: 400px;">
                    <span class="input-group-text bg-white border-end-0" style="border-radius: 10px 0 0 10px;">
                        <i class="bi bi-search" style="color: #FF782D;"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 custom-input" id="search"
                        placeholder="Cari nama ibu hamil..."
                        value="{{ request('search') }}" style="border-radius: 0 10px 10px 0;">
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle custom-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Tanggal & Petugas</th>
                            <th>Identitas Ibu</th>
                            <th>Fisik (BB/TB/LILA)</th>
                            <th class="text-center">Kehamilan</th>
                            <th class="text-center">IMT & Status</th>
                            <th style="width: 10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pengukuran-ibuhamil-table">
                        @forelse ($p_ibuhamil as $index => $ibu)
                            <tr>
                                <td class="fw-bold text-muted">{{ $p_ibuhamil->firstItem() + $index }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($ibu->tanggal)->translatedFormat('d M Y') }}</div>
                                    <small class="text-muted"><i class="bi bi-person-badge me-1"></i>{{ $ibu->petugas->nama ?? '-' }}</small>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $ibu->ibuHamil->nama ?? '-' }}</div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($ibu->ibuHamil->tgl_lahir)->age }} Tahun</small>
                                </td>
                                <td>
                                    <div class="small">
                                        <span class="badge bg-blue-soft text-primary mb-1">BB: {{ $ibu->berat_badan }}kg</span>
                                        <span class="badge bg-green-soft text-success mb-1">TB: {{ $ibu->tinggi_badan }}cm</span>
                                        <br>
                                        <span class="badge bg-purple-soft text-purple">LILA: {{ $ibu->lila }}cm</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="badge bg-light text-dark border px-3 py-2" style="border-radius: 8px;">
                                        {{ $ibu->usia_kehamilan }} <small>Minggu</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="fw-bold text-dark mb-1">IMT: {{ $ibu->imt }}</div>
                                    @php
                                        $statusClass = match(strtolower($ibu->status_gizi)) {
                                            'gizi kurang' => 'bg-danger',
                                            'gizi normal', 'normal' => 'bg-success',
                                            'gizi lebih', 'obesitas' => 'bg-warning text-dark',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }} px-2 py-1" style="font-size: 10px; border-radius: 5px;">
                                        {{ strtoupper($ibu->status_gizi) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('pengukuran_ibu_hamil.detail', $ibu->id) }}" class="btn btn-sm btn-detail-custom" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('pengukuran_ibu_hamil.destroy', $ibu->id) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-delete-custom" onclick="return confirm('Hapus data pengukuran ini?')" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-clipboard-x d-block mb-2" style="font-size: 3rem; color: #dee2e6;"></i>
                                    Belum ada data pengukuran ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $p_ibuhamil->withQueryString()->links() }}
            </div>
        </div>
    </div>

<style>
    .custom-table th { color: #7a7a7a; font-weight: 600; text-transform: uppercase; font-size: 11px; padding: 15px; border: none; }
    .custom-table td { padding: 15px; border-bottom: 1px solid #f8f9fa; }

    /* Soft Badges */
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
        fetch(`{{ route('pengukuran_ibu_hamil.index') }}?search=` + query)
        .then(response => response.text())
        .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');

            let newTable = doc.querySelector('#pengukuran-ibuhamil-table').innerHTML;
            document.getElementById('pengukuran-ibuhamil-table').innerHTML = newTable;
        });
    }, 300);
});

</script>

@endsection
