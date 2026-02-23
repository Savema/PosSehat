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
                            <th style="width: 5%">No</th>
                            <th>Nama Balita</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Orang Tua</th>
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="badge bg-pink"></span>
                            </td>
                            <td></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
