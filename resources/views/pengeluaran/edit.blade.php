@extends('layouts.app')

@section('content')
<h1>Edit pengeluaran</h1>
<form action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $pengeluaran->jumlah }}" required>
    </div>
    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select class="form-control" id="kategori_id" name="kategori_pengeluaran_id" required>
            <option value="" disabled>Pilih Kategori</option>
            @foreach($kategori as $kat)
                <option value="{{ $kat->id }}" {{ $pengeluaran->kategori_pengeluaran_id == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $pengeluaran->deskripsi }}</textarea>
    </div>
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pengeluaran->tanggal }}"
            required>
    </div>

    <div class="text-end">
        <a href="{{ route('pemasukan.index') }}" class="btn btn-danger me-2">Cancel</a>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>
@endsection