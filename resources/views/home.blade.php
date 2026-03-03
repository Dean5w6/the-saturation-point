@extends('layouts.app')
@section('title', 'The Saturation Point - Fine Writing Instruments')

@section('content') 
<div class="text-center py-5 my-5">
    <h1 class="display-3 fw-bold font-playfair" style="color: var(--ink-blue);">The Art of <span style="color: var(--gold-accent); font-style: italic;">Fine Writing</span></h1>
    <p class="lead text-muted mt-3 mb-4 mx-auto" style="max-width: 600px;">Discover our curated collection of luxury fountain pens, premium bottled inks, and archival-quality paper for the discerning writer.</p>
    <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-5">EXPLORE THE COLLECTION</a>
</div>
 
<div class="row text-center mb-5 pb-5 border-bottom">
    <div class="col-12">
        <h2 class="font-playfair mb-5">Browse Our Collection</h2>
    </div>
    @foreach($categories as $category) 
        <div class="col-md-4 mb-4"> 
            <a href="{{ route('home', ['category' => $category->id]) }}" class="card text-decoration-none text-dark shadow-sm product-card h-100"> 
                <div class="card-body p-5 d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-pen-fancy fa-3x mb-3" style="color: var(--gold-accent);"></i>
                    <h4 class="font-playfair">{{ $category->name }}</h4>
                </div>
            </a>
        </div>
    @endforeach
</div>
 
<div class="row mb-4">
    <div class="col-12 text-center">
        <h2 class="font-playfair">Featured Arrivals</h2>
        <p class="text-muted">Hand-selected instruments added to our collection.</p>
    </div>
</div>

<div class="row g-4">
    @forelse($featuredProducts as $product)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm product-card">
                @if($product->img_path)
                    <img src="{{ Storage::url($product->img_path) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                @else
                    <div style="height: 250px; background-color: #e9ecef; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-pen-nib fa-3x text-muted"></i>
                    </div>
                @endif
                
                <div class="card-body text-center d-flex flex-column">
                    <p class="text-muted small mb-1 text-uppercase ls-1">{{ $product->brand }}</p>
                    <h5 class="card-title font-playfair" style="color: var(--ink-blue);">{{ $product->name }}</h5>
                    <h6 class="fw-bold mb-3 mt-auto" style="color: var(--gold-accent);">₱{{ number_format($product->price, 2) }}</h6>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-dark btn-sm w-100" style="border-radius: 2px;">View Details</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">No featured products at the moment.</p>
        </div>
    @endforelse
</div>
@endsection