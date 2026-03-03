@extends('layouts.app')

@section('title', 'Login - The Saturation Point')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-white text-center py-4">
                <h3 class="mb-0" style="color: var(--ink-blue);">Welcome Back</h3>
                <p class="text-muted small mb-0">Sign in to access your collection</p>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('login') }}" method="POST" novalidate>
                    @csrf
                     
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
 
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3 bg-light">
                <span class="text-muted">New here?</span>
                <a href="{{ route('register') }}" style="color: var(--ink-blue); font-weight: bold;">Create Account</a>
            </div>
        </div>
    </div>
</div>
@endsection