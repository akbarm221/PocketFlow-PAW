@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <!-- Filter Tombol -->
    <div class="mb-4">
        <a href="{{ route('dashboard', ['filter' => 'all']) }}"
            class="filter-button {{ $filter == 'all' ? 'active' : '' }}">Semua</a>
        <a href="{{ route('dashboard', ['filter' => 'month']) }}"
            class="filter-button {{ $filter == 'month' ? 'active' : '' }}">Bulan Ini</a>
        <a href="{{ route('dashboard', ['filter' => 'week']) }}"
            class="filter-button {{ $filter == 'week' ? 'active' : '' }}">Minggu Ini</a>
    </div>

    <div class="container">
        <h1 class="mb-4 text-center dashboard-title">Dashboard</h1>

        <!-- Kartu Informasi -->
        <div class="row text-center position-relative">
            <!-- Kartu Pemasukan -->
            <div class="col-md-4">
                <div class="position-relative">
                    <h6 class="card-label">Pemasukan</h6>
                    <div class="card shadow-sm border-0 position-relative info-card">
                        <div class="card-body">
                            <div class="info-value bg-success text-white">
                                <h4 class="fw-bold">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</h4>
                            </div>
                            <hr class="custom-divider">
                            <p class="text-muted mb-0">Total Pemasukan</p>
                        </div>
                        <!-- Tombol Details -->
                        <a href="{{ route('pemasukan.index') }}"
                            class="details-button position-absolute bottom-0 end-0 m-3 d-flex align-items-center justify-content-center">
                            Details
                            <span class="ms-2">&gt;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kartu Pengeluaran -->
            <div class="col-md-4">
                <div class="position-relative">
                    <h6 class="card-label">Pengeluaran</h6>
                    <div class="card shadow-sm border-0 position-relative info-card">
                        <div class="card-body">
                            <div class="info-value bg-danger text-white">
                                <h4 class="fw-bold">Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</h4>
                            </div>
                            <hr class="custom-divider">
                            <p class="text-muted mb-0">Total Pengeluaran</p>
                        </div>
                        <!-- Tombol Details -->
                        <a href="{{ route('pengeluaran.index') }}"
                            class="details-button position-absolute bottom-0 end-0 m-3 d-flex align-items-center justify-content-center">
                            Details
                            <span class="ms-2">&gt;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kartu Goals -->
            <div class="col-md-4">
                <div class="position-relative">
                    <h6 class="card-label">Goals</h6>
                    <div class="card shadow-sm border-0 position-relative info-card">
                        <div class="card-body">
                            @if ($goal)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="text-muted mb-0">#1</h6>
                                    <div>
                                        <i class="fas fa-bullseye text-secondary me-2" style="font-size: 18px;"></i>
                                        <i class="fas fa-trophy text-secondary" style="font-size: 18px;"></i>
                                    </div>
                                </div>
                                <hr class="custom-divider">
                                <h5 class="fw-bold">{{ $goal->goals }}</h5>
                            @else
                                <p class="text-muted">No goals available.</p>
                            @endif
                        </div>
                        <!-- Tombol Details -->
                        <a href="{{ route('goals.index') }}"
                            class="details-button position-absolute bottom-0 end-0 m-3 d-flex align-items-center justify-content-center">
                            Detail
                            <span class="ms-2">&gt;</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Tabel Top 5 Pengeluaran -->
    <div class="container mt-5">
        <div class="pengeluaran-card">
            <h4 class="pengeluaran-title">Top 5 Pengeluaran</h4>
            <div class="table-responsive">
                <table class="pengeluaran-table">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Kategori</th>
                            <th class="text-end align-middle">Total Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topPengeluaran as $index => $pengeluaran)
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="text-center align-middle">{{ $pengeluaran->nama }}</td>
                                <td class="text-end align-middle">Rp {{ number_format($pengeluaran->total, 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    @endsection