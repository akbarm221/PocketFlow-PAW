@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>

    <!-- Filter -->
    <form method="GET" action="{{ route('dashboard') }}">
        <div class="mb-3">
            <label for="filter" class="form-label">Filter berdasarkan:</label>
            <select name="filter" id="filter" class="form-select" onchange="this.form.submit()">
                <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Seluruhnya</option>
                <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Bulan Ini</option>
            </select>
        </div>
    </form>

    <!-- Total Pemasukan dan Pengeluaran -->
    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Pemasukan</div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Pengeluaran</div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Top 5 Pengeluaran Berdasarkan Kategori -->
    <h4>Top 5 Pengeluaran Berdasarkan Kategori</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Total Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topPengeluaran as $pengeluaran)
                <tr>
                    <td>{{ $pengeluaran->nama }}</td>
                    <td>Rp {{ number_format($pengeluaran->total, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
