@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Data Pemasukan</h4>
        <a href="{{ route('pemasukan.create') }}" class="btn btn-success">+ Tambahkan Pemasukan</a>
    </div>

    <!-- Filter -->
    <div class="mb-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link {{ $filter == 'all' ? 'active' : '' }}" href="{{ route('pemasukan.index', ['filter' => 'all']) }}">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $filter == 'week' ? 'active' : '' }}" href="{{ route('pemasukan.index', ['filter' => 'week']) }}">Minggu ini</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $filter == 'month' ? 'active' : '' }}" href="{{ route('pemasukan.index', ['filter' => 'month']) }}">Bulan ini</a>
            </li>
        </ul>
    </div>

    <!-- Data Card -->
    <div class="card">
        <div class="card-body">
            @forelse ($pemasukan as $index => $item)
            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                <!-- Left Side: Data -->
                <div>
                    <div class="fw-bold">#{{ $index + 1 }}. RP. {{ number_format($item->jumlah, 2) }}</div>
                    <div class="text-muted">{{ $item->tanggal }}</div>
                    <div class="text-muted">{{ $item->deskripsi }}</div>
                    <small class="text-muted">Kategori: {{ $item->kategori->nama }}</small>
                </div>

                <!-- Right Side: Actions -->
                <div>
                    <a href="{{ route('pemasukan.edit', $item->id) }}" class="btn btn-sm btn-warning me-2">Update</a>
                    <form action="{{ route('pemasukan.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this data?');">Delete</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center text-muted py-3">
                No data available.
            </div>
            @endforelse

        </div>
    </div>
</div>
@endsection
