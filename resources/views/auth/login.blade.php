@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h3 class="text-center">Login</h3>
        <form method="POST" action="/login">
            @csrf

            <!-- Menampilkan pesan error jika login gagal -->
            @if ($errors->has('loginError'))
                <div class="alert alert-danger">
                    {{ $errors->first('loginError') }}
                </div>
            @endif

            <!-- Menampilkan pesan status jika ada -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Input Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- Input Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Tombol Login -->
            <button type="submit" class="btn btn-primary w-100">Login</button>

            <!-- Link tambahan -->
            <div class="mt-4">
                <a href="/register">Tidak Punya Akun? Daftar</a><br>
                <a href="/forgot-password" class="text-danger" >Lupa Password? Klik Disini</a>
            </div>
        </form>
    </div>
</div>
@endsection
