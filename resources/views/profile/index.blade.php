@extends('layouts.app') <!-- Pastikan layout utama Anda -->

@section('content')
<div class="container mt-4 profile-container">
    <h1>My Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Card Wrapper -->
    <div class="profile-card">
        <div class="card-body">
            <!-- Tombol Account dan Security -->
            <div class="d-flex justify-content-start mb-3 profile-buttons">
                <!-- Tombol Account -->
                <a href="#" class="btn profile-tab {{ request()->is('profile/account') ? 'active' : '' }} me-2">
                    Account
                </a>

                <!-- Tombol Security -->
                <a href="{{ route('profile.changePassword') }}"
                    class="btn profile-tab {{ request()->is('profile/security') ? 'active' : '' }}">
                    Security
                </a>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                class="profile-form">
                @csrf <!-- Laravel CSRF token untuk keamanan -->

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control profile-input"
                        value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control profile-input"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control profile-input">

                    @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                            class="img-thumbnail mt-3" style="width: 150px; height: 150px;">
                    @endif
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn profile-submit">Update Profile</button>
            </form>

        </div>
    </div>
</div>
@endsection