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
                    <tbody>
                        @forelse ($balita as $index => $balitas)
                            <tr>
                                <td>{{ $index + 1 }}</td>
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

          {{-- <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pagination with icon</h5>

              <!-- Pagination with icons -->
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav><!-- End Pagination with icons -->

            </div>
          </div> --}}
        </div>
    </div>

@endsection
