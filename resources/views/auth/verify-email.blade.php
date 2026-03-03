@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white text-center py-4">
                <h3 class="mb-0" style="color: var(--ink-blue);">Verify Your Email</h3>
            </div>
            <div class="card-body p-5 text-center">
                <i class="fas fa-envelope-open-text fa-4x mb-3" style="color: var(--gold-accent);"></i>
                <p class="lead">Thanks for signing up!</p>
                <p class="text-muted">Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>
                
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mt-4 d-flex justify-content-center gap-2">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection