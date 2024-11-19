@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h3 class="text-center">Forgot Password</h3>
        <form method="POST" action="{{ route('forgot-password.process') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
            <div class="mt-3">
                <a href="/login">Back to Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
