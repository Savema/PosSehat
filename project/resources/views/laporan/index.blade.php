@extends('layouts.dashboard')

@section('title', 'Laporan Rekapitulasi')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="pagetitle mb-4">
    <h1 style="color: #FF782D; font-weight: 700;">Laporan PosSehat</h1>
    <p class="text-muted">Rekapitulasi data bulanan dan tahunan PosSehat.</p>
</div>

<div class="card shadow-sm border-0 mb-4" style="border-radius: 20px;">
    <div class="card-body p-4">
        <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Bulan</label>
                <select name="bulan" class="form-select custom-input">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ request('bulan', date('n')) == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Tahun</label>
                <select name="tahun" class="form-select custom-input">
                    @foreach(range(date('Y')-2, date('Y')) as $y)
                        <option value="{{ $y }}" {{ request('tahun', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="btn-group shadow-sm rounded-pill overflow-hidden">
                    <button type="submit" class="btn btn-orange px-4"><i class="bi bi-filter me-1"></i> Filter</button>
                    <a id="exportExcelBtn" class="btn btn-success px-3" style="cursor: pointer;"><i class="bi bi-file-earmark-excel"></i> Excel</a>
                    <a id="exportPdfBtn" class="btn btn-danger px-3" style="cursor: pointer;"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- <div class="row mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm p-3 card-stat">
            <div class="d-flex align-items-center">
                <div class="icon-stat bg-orange-light text-orange me-3"><i class="bi bi-people fs-4"></i></div>
                <div><small class="text-muted d-block">Total Balita</small><h4 class="fw-bold mb-0">124</h4></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm p-3 card-stat">
            <div class="d-flex align-items-center">
                <div class="icon-stat bg-pink-light text-danger me-3"><i class="bi bi-heart-pulse fs-4"></i></div>
                <div><small class="text-muted d-block">Ibu Hamil</small><h4 class="fw-bold mb-0">45</h4></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm p-3 card-stat" style="border-bottom: 3px solid #dc3545;">
            <div class="d-flex align-items-center">
                <div class="icon-stat bg-danger-soft text-danger me-3"><i class="bi bi-exclamation-circle fs-4"></i></div>
                <div><small class="text-muted d-block">Indikasi Stunting</small><h4 class="fw-bold mb-0 text-danger">8</h4></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm p-3 card-stat" style="border-bottom: 3px solid #28a745;">
            <div class="d-flex align-items-center">
                <div class="icon-stat bg-success-soft text-success me-3"><i class="bi bi-shield-check fs-4"></i></div>
                <div><small class="text-muted d-block">Gizi Normal</small><h4 class="fw-bold mb-0 text-success">116</h4></div>
            </div>
        </div>
    </div>
</div> --}}

<div class="card shadow-sm border-0" style="border-radius: 20px;">
    <div class="card-body p-4">
        <ul class="nav nav-pills mb-4 gap-2 bg-light p-2 rounded-pill" id="pills-tab" role="tablist" style="width: fit-content;">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4" id="pills-balita-tab" data-bs-toggle="pill" data-bs-target="#pills-balita">Data Balita</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4" id="pills-ibu-tab" data-bs-toggle="pill" data-bs-target="#pills-ibu">Data Ibu Hamil</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-balita" role="tabpanel">
                <h6 class="fw-bold mb-3">Rekapitulasi Pengukuran Balita</h6>
                <div class="table-responsive">
                    <table class="table table-hover align-middle custom-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama & Usia Balita</th>
                                <th>BB/TB</th>
                                <th>Z-Score TB/U</th>
                                <th>Status Gizi</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody id="balita-table">
                            @forelse ($laporanBalita as $index => $item)
                                <tr>
                                    <td class="fw-bold text-muted">{{ $index + 1 }}</td>
                                    <td>{{ $item->balita->nik ?? '-' }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $item->balita->nama ?? '-' }}</div>
                                        <small class="text-muted">{{ $item->usia_saat_ukur }} Bulan</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-blue-soft text-primary">BB: {{ $item->berat_badan }}kg</span><br>
                                        <span class="badge bg-green-soft text-success">TB: {{ $item->tinggi_badan }}cm</span>
                                    </td>
                                    <td><span class="badge bg-light text-dark">{{ $item->zs_tbu }}</span></td>
                                    <td>
                                        @php
                                            $statusClass = match(strtolower($item->hasil)) {
                                                'normal' => 'bg-success',
                                                'pendek', 'sangat pendek' => 'bg-danger',
                                                default => 'bg-warning'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-3 py-2" style="border-radius: 8px;">
                                            {{ strtoupper($item->hasil) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="small fw-semibold">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</div>
                                        <small class="text-muted">{{ $item->petugas->nama ?? '-' }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">Data pengukuran balita bulan ini kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div> <div class="tab-pane fade" id="pills-ibu" role="tabpanel">
                <h6 class="fw-bold mb-3">Rekapitulasi Pengukuran Ibu Hamil</h6>
                <div class="table-responsive">
                    <table class="table table-hover align-middle custom-table">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Identitas Ibu</th>
                                <th>Usia Hamil</th>
                                <th>Fisik (BB/TB/LILA)</th>
                                <th class="text-center">IMT & Status</th>
                                <th>Tanggal & Petugas</th>
                            </tr>
                        </thead>
                        <tbody id="ibuhamil-table">
                            @forelse ($laporanIbuHamil as $index => $item)
                                <tr>
                                    <td class="fw-bold text-muted">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $item->ibuHamil->nama ?? '-' }}</div>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($item->ibuHamil->tgl_lahir)->age }} Tahun</small>
                                    </td>
                                    <td><div class="text-dark-bold">{{ $item->usia_kehamilan ?? '0' }} Minggu</div></td>
                                    <td>
                                        <div class="small">
                                            <span class="badge bg-blue-soft text-primary mb-1">BB: {{ $item->berat_badan }}kg</span>
                                            <span class="badge bg-green-soft text-success mb-1">TB: {{ $item->tinggi_badan }}cm</span><br>
                                            <span class="badge bg-purple-soft text-purple">LILA: {{ $item->lila ?? '-' }} cm</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="fw-bold text-dark mb-1">IMT: {{ $item->imt ?? '0' }}</div>
                                        @php
                                            $statusIbu = match(strtolower($item->status_gizi ?? '')) {
                                                'gizi kurang' => 'bg-danger',
                                                'gizi normal', 'normal' => 'bg-success',
                                                'gizi lebih', 'obesitas' => 'bg-warning text-dark',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusIbu }} px-2 py-1" style="font-size: 10px;">
                                            {{ strtoupper($item->status_gizi ?? 'TIDAK ADA DATA') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="small fw-semibold">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</div>
                                        <small class="text-muted">{{ $item->petugas->nama ?? '-' }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">Data pengukuran ibu hamil bulan ini kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div> </div> </div>
</div>

<style>
    .card-stat { border-radius: 15px; transition: transform 0.3s; }
    .card-stat:hover { transform: translateY(-5px); }
    .icon-stat { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 12px; }
    .bg-danger-soft { background-color: #fff5f5; }
    .bg-success-soft { background-color: #f0fff4; }
    .btn-orange { background-color: #FF782D; color: white; border: none; }
    .nav-pills .nav-link.active { background-color: #FF782D !important; }
    .custom-input { border-radius: 10px !important; }
    .custom-table thead th { font-size: 11px; text-transform: uppercase; color: #888; letter-spacing: 0.5px; border-top: none; }
    .bg-purple-soft { background-color: #f3e8ff !important; border: 1px solid #d8b4fe; }
    .text-purple { color: #6b21a8 !important; font-weight: 600; }
    .text-dark-bold { color: #2c3e50 !important; font-weight: 700; }
    .bg-blue-soft { background-color: #e7f3ff; }
    .bg-green-soft { background-color: #f0fff4; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let kategoriAktif = 'balita';

        // Update kategori saat tab diklik
        const tabButtons = document.querySelectorAll('button[data-bs-toggle="pill"]');
        tabButtons.forEach(button => {
            button.addEventListener('shown.bs.tab', function (e) {
                kategoriAktif = e.target.id === 'pills-balita-tab' ? 'balita' : 'ibu_hamil';
            });
        });

        // Interceptor Download
        const handleDownload = (e, type) => {
            e.preventDefault();
            const bulan = document.querySelector('select[name="bulan"]').value;
            const tahun = document.querySelector('select[name="tahun"]').value;

            const tableId = kategoriAktif === 'balita' ? 'balita-table' : 'ibuhamil-table';
            const tableContent = document.getElementById(tableId).innerText;

            if (tableContent.includes('kosong') || tableContent.includes('Data tidak ditemukan')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Kosong!',
                    text: `Maaf, tidak ada data ${kategoriAktif.replace('_', ' ')} untuk diunduh.`,
                    confirmButtonColor: '#FF782D',
                });
            } else {
                const route = type === 'excel' ? '/laporan/excel' : '/laporan/pdf';
                window.location.href = `${route}?kategori=${kategoriAktif}&bulan=${bulan}&tahun=${tahun}`;
            }
        };

        document.getElementById('exportExcelBtn').addEventListener('click', (e) => handleDownload(e, 'excel'));
        document.getElementById('exportPdfBtn').addEventListener('click', (e) => handleDownload(e, 'pdf'));
    });
</script>
@endsection
