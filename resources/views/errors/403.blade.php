@extends('layouts.app')
@section('title', 'Access Denied')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="p-5 shadow-sm bg-white" style="border-top: 5px solid var(--gold-accent);">
                <i class="fas fa-user-lock fa-4x mb-4" style="color: var(--ink-blue);"></i>
                <h2 class="font-playfair mb-3" style="color: var(--ink-blue);">Access Restricted</h2>
                <p class="text-muted mb-4">You do not have the required permissions to view this area. Please return to the shop or contact the administrator if you believe this is an error.</p>
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('home') }}" class="btn btn-primary px-4">RETURN TO SHOP</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-dark px-4" style="border-radius: 2px;">LOGIN AS ADMIN</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection