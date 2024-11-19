@extends('layouts.app')

@section('content')
<h1>Edit Pemasukan</h1>
<form action="{{ route('pemasukan.update', $pemasukan->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $pemasukan->jumlah }}" required>
    </div>
    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select class="form-control" id="kategori_id" name="kategori_id" required>
            <option value="" disabled>Pilih Kategori</option>
            @foreach($kategori as $kat)
                <option value="{{ $kat->id }}" {{ $pemasukan->kategori_id == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $pemasukan->deskripsi }}</textarea>
    </div>
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pemasukan->tanggal }}" required>
    </div>

    <div class="text-end">
        <a href="{{ route('pemasukan.index') }}" class="btn btn-secondary me-2">Cancel</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
@endsection