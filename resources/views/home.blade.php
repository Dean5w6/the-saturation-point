@extends('layouts.app')
@section('title', 'The Saturation Point - Fine Writing Instruments')
 
@section('hero')
<style>
    #hero-scroll-container { height: 300vh; position: relative; }
    #sticky-hero { position: sticky; top: 0; height: 100vh; width: 100%; overflow: hidden; background-color: #000; }
    #hero-video { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1; }
    #hero-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); z-index: 2; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; will-change: opacity; }
    @keyframes bounce { 0%, 20%, 50%, 80%, 100% {transform: translateY(0);} 40% {transform: translateY(-10px);} 60% {transform: translateY(-5px);} }
    .fade-animation { animation: bounce 2s infinite; }
</style>

<div id="hero-scroll-container">
    <div id="sticky-hero"> 
        <video id="hero-video" 
       src="{{ asset('assets/videos/final_hero_animation_v6.mp4') }}?t={{ time() }}" 
       muted playsinline preload="auto"></video>
        
        <div id="hero-overlay">
            <h1 class="display-2 fw-bold font-playfair text-white">
                The Art of <br><span style="color: var(--gold-accent); font-style: italic;">Fine Writing</span>
            </h1>
            <p class="lead text-white-50 mt-3 mb-4 mx-auto px-3" style="max-width: 600px;">
                Discover our curated collection of luxury fountain pens, premium bottled inks, and archival-quality paper.
            </p>
            <div class="mt-4">
                <p class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 2px;">Scroll to Explore</p>
                <i class="fas fa-chevron-down text-white-50 fade-animation"></i>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('content') 
<div class="row text-center mb-5 pb-5 border-bottom mt-5 pt-5">
    <div class="col-12">
        <h2 class="font-playfair mb-5" style="color: var(--ink-blue);">Browse Our Collection</h2>
    </div>
    @foreach($categories as $category)
        @php
            $iconClass = match($category->name) {
                'Fountain Pens' => 'fa-pen-fancy',
                'Inks' => 'fa-tint',
                'Paper' => 'fa-book-open',
                'Accessories' => 'fa-toolbox',
                'Maintenance' => 'fa-tools',
                default => 'fa-box'
            };
        @endphp
        <div class="col-md-4 mb-4">
            <a href="{{ route('home', ['category' => $category->id]) }}" class="card text-decoration-none text-dark shadow-sm product-card h-100 border-0">
                @if($category->img_path)
                    <img src="{{ Storage::url($category->img_path) }}" class="card-img-top" alt="{{ $category->name }}" style="height: 200px; object-fit: cover;">
                @else
                    <div style="height: 200px; background-color: var(--ink-blue); display: flex; align-items: center; justify-content: center;">
                        <i class="fas {{ $iconClass }} fa-3x" style="color: var(--gold-accent);"></i>
                    </div>
                @endif
                <div class="card-body p-4 text-center">
                    <h4 class="font-playfair mb-0" style="color: var(--ink-blue);">{{ $category->name }}</h4>
                </div>
            </a>
        </div>
    @endforeach
</div>
 
<div class="row mb-4">
    <div class="col-12 text-center">
        <h2 class="font-playfair" style="color: var(--ink-blue);">Featured Arrivals</h2>
        <p class="text-muted">Hand-selected instruments added to our collection.</p>
    </div>
</div>

<div class="row g-4 mb-5">
    @forelse($featuredProducts as $product)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm product-card">
                <div style="height: 250px; overflow: hidden; background-color: #f8f9fa;">
                    @if($product->img_path)
                        <img src="{{ Storage::url($product->img_path) }}" 
                             class="card-img-top h-100 w-100" 
                             style="object-fit: cover;" 
                             alt="{{ $product->name }}">
                    @else
                        <div class="h-100 w-100 d-flex align-items-center justify-content-center">
                            <i class="fas fa-pen-nib fa-3x text-muted"></i>
                        </div>
                    @endif
                </div>
                
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

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.getElementById('hero-scroll-container');
        const video = document.getElementById('hero-video');
        const overlay = document.getElementById('hero-overlay');
 
        const videoUrl = "{{ asset('assets/videos/final_hero_animation_v6.mp4') }}";
        
        fetch(videoUrl)
            .then(response => response.blob())
            .then(blob => { 
                const blobUrl = URL.createObjectURL(blob);
                video.src = blobUrl;
                 
                video.addEventListener('loadedmetadata', function() {
                    updateVideoOnScroll();
                    console.log("Video fully loaded into RAM. Scrubbing enabled.");
                });
            })
            .catch(error => console.error("Error loading video as blob:", error));

        function updateVideoOnScroll() {
            if (!video.duration || isNaN(video.duration)) return;

            const rect = container.getBoundingClientRect();
            const scrollableDistance = rect.height - window.innerHeight;
            
            let scrollProgress = -rect.top / scrollableDistance;
            scrollProgress = Math.max(0, Math.min(1, scrollProgress));
             
            video.currentTime = video.duration * (scrollProgress * 0.99);
 
            let opacity = 1 - (scrollProgress * 3); 
            overlay.style.opacity = Math.max(0, Math.min(1, opacity));
        }

        window.addEventListener('scroll', () => window.requestAnimationFrame(updateVideoOnScroll));
    });
</script>
@endsection