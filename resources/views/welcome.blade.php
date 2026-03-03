@extends('layouts.app')
@section('title', 'Home - The Saturation Point')

@section('content') 
<div class="row align-items-center mb-5 pb-5 border-bottom">
    <div class="col-md-7">
        <h1 class="display-3 fw-bold font-playfair" style="color: var(--ink-blue);">The Art of <br><span style="color: var(--gold-accent); font-style: italic;">Fine Writing</span></h1>
        
        {{-- Added mb-5 for more space --}}
        <p class="lead text-muted mt-3 mb-5" style="max-width: 500px;">Discover our curated collection of luxury fountain pens, premium bottled inks, and archival-quality paper.</p>
    </div>
    <div class="col-md-5"> 
        <div class="card shadow-sm border-0 p-4" style="background-color: var(--ink-blue);">
            <h5 class="text-white mb-3 font-playfair">Find Your Next Instrument</h5>
            <form action="{{ route('home') }}" method="GET">
                <div class="input-group">
                    {{-- Added font-size styling --}}
                    <input type="text" name="search" class="form-control" placeholder="Search by name, brand..." value="{{ request('search') }}" style="font-size: 0.9rem; border-radius: 2px;">
                    <button class="btn fw-bold" style="background-color: var(--gold-accent); color: var(--ink-blue); border-radius: 2px;" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row"> 
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="border-bottom pb-2 font-playfair" style="color: var(--ink-blue);">Filter Collection</h5>
                
                <form action="{{ route('home') }}" method="GET"> 
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <div class="mb-3 mt-3">
                        <label class="form-label small fw-bold text-uppercase">Category</label>
                        <select name="category" class="form-select form-select-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase">Brand</label>
                        <select name="brand" class="form-select form-select-sm">
                            <option value="">All Brands</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase">Price Range (₱)</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="{{ request('min_price') }}">
                            </div>
                            <div class="col-6">
                                <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">APPLY FILTERS</button>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">CLEAR</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
    <div class="col-md-9">
        <div class="row g-4 mb-4">
            @forelse($products as $product)
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
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h4>No products found</h4>
                    <p class="text-muted">Try adjusting your filters or search term.</p>
                </div>
            @endforelse
        </div>
         
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection