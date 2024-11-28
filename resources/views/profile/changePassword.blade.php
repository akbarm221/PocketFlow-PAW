@extends('layouts.app')

@section('content')
<div class="container mt-4 profile-container">
    <h1>Change Password</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Wrapper -->
    <div class="card profile-card-pw">
        <div class="card-body">
            <!-- Tombol Account dan Security -->
            <div class="d-flex justify-content-start mb-3 profile-buttons">
                <!-- Tombol Account -->
                <a href="{{ route('profile.index') }}" class="btn profile-tab {{ request()->is('profile/account') ? 'active' : '' }} me-2">
                    Account
                </a>

                <!-- Tombol Security -->
                <a href="{{ route('profile.changePassword') }}" class="btn profile-tab {{ request()->is('profile/security') ? 'active' : '' }}">
                    Security
                </a>
            </div>

            <!-- Form Ganti Password -->
            <form action="{{ route('profile.changePassword') }}" method="POST" class="profile-form">
                @csrf

                <!-- Password Lama -->
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control profile-input" required>
                </div>

                <!-- Password Baru -->
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" name="password" id="password" class="form-control profile-input" required>
                </div>

                <!-- Konfirmasi Password Baru -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Retype New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control profile-input" required>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary profile-submit-pw">Update Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
