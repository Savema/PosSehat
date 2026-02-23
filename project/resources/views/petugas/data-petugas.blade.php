@extends('layouts.dashboard')

@section('title', 'Data Petugas')

@section('content')

<div class="pagetitle mb-4">
    <h1 style="color: #9c3a5b;">Data Petugas</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Daftar Petugas</h5>

            <a href="{{ url('tambah-petugas') }}" class="btn btn-success btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Petugas
            </a>
        </div>

        <div class="datatable-wrapper">
            <div class="table-responsive">
                <table class="table table-hover align-middle datatable">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width: 15%">Role</th>
                        <th style="width: 15%" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Dewi Lestari</td>
                        <td>dewi@example.com</td>
                        <td>
                            <span class="badge bg-primary">Admin</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning me-1" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Agus Prabowo</td>
                        <td>agus@example.com</td>
                        <td>
                            <span class="badge bg-secondary">Petugas</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
