@extends('layouts.app')
@section('title', $product->name . ' - The Saturation Point')

@section('content')
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--ink-blue);">Home</a></li>
        <li class="breadcrumb-item active">{{ $product->category->name ?? 'Uncategorized' }}</li>
        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
    </ol>
</nav>

<div class="card shadow-sm border-0 mb-5">
    <div class="row g-0"> 
        <div class="col-md-5 border-end bg-white">
            <div class="ratio ratio-1x1">
                <div id="productCarousel" class="carousel slide h-100 w-100" data-bs-ride="carousel">
                    <div class="carousel-inner h-100 w-100">
                        <div class="carousel-item active h-100 w-100">
                            <img src="{{ Storage::url($product->img_path) }}" 
                                 class="d-block w-100 h-100" 
                                 style="object-fit: contain; padding: 1rem;" 
                                 alt="{{ $product->name }}">
                        </div>
                        @foreach($product->images as $image)
                            <div class="carousel-item h-100 w-100">
                                <img src="{{ Storage::url($image->img_path) }}" 
                                     class="d-block w-100 h-100" 
                                     style="object-fit: contain; padding: 1rem;" 
                                     alt="Gallery">
                            </div>
                        @endforeach
                    </div>
                    
                    @if($product->images->count() > 0)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev" style="width: 15%;">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true" style="background-size: 50%;"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next" style="width: 15%;">
                            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true" style="background-size: 50%;"></span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
         
        <div class="col-md-7 bg-white">
            <div class="card-body p-5 h-100 d-flex flex-column justify-content-center">
                <p class="text-muted text-uppercase ls-1 mb-1">{{ $product->brand }}</p>
                <h2 class="font-playfair mb-3 display-6" style="color: var(--ink-blue);">{{ $product->name }}</h2>
                <h3 class="fw-bold mb-4" style="color: var(--gold-accent);">₱{{ number_format($product->price, 2) }}</h3>
                
                <p class="lead text-dark mb-4" style="font-size: 1rem; line-height: 1.8;">{{ $product->description }}</p>
                
                <hr class="my-4 text-muted opacity-25">

                <div class="mt-2">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }} px-3 py-2" style="font-weight: 500; letter-spacing: 0.5px;">
                            {{ $product->stock > 0 ? 'IN STOCK (' . $product->stock . ')' : 'OUT OF STOCK' }}
                        </span>
                    </div>

                    @guest
                        <div class="p-4 bg-light rounded text-center border border-light">
                            <i class="fas fa-lock mb-2 fa-lg text-muted"></i>
                            <h6 class="mb-3 text-muted">Sign in to purchase</h6>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('login') }}" class="btn btn-primary px-4">LOGIN</a>
                                <a href="{{ route('register') }}" class="btn btn-outline-dark px-4" style="border-radius: 2px;">REGISTER</a>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex align-items-stretch" novalidate>
                            @csrf
                            <div class="me-2">
                                <input type="number" name="quantity" class="form-control text-center h-100 fs-5" value="1" min="1" max="{{ $product->stock }}" style="width: 80px;" {{ $product->stock == 0 ? 'disabled' : '' }}>
                            </div>
                            <button type="submit" class="btn btn-primary flex-grow-1" style="height: 50px; font-size: 1.1rem;" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                <i class="fas fa-shopping-bag me-2"></i> ADD TO CART
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body p-4">
                @php
                    $myReview = $product->reviews->where('user_id', Auth::id())->first();
                    $otherReviews = $product->reviews->where('user_id', '!=', Auth::id());
                @endphp

                @auth
                    @if($canReview && !$myReview)
                        <h4 class="font-playfair mb-4" style="color: var(--ink-blue);">Write a Review</h4>
                        <form action="{{ route('reviews.store') }}" method="POST" class="mb-5 p-4 bg-light rounded shadow-sm border" novalidate>
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-uppercase ls-1">Rating</label>
                                <select name="rating" class="form-select" required>
                                    <option value="5">5 Stars (Excellent)</option>
                                    <option value="4">4 Stars (Good)</option>
                                    <option value="3" selected>3 Stars (Average)</option>
                                    <option value="2">2 Stars (Fair)</option>
                                    <option value="1">1 Star (Poor)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-uppercase ls-1">Your Comment (Optional)</label>
                                <textarea name="comment" rows="3" class="form-control" placeholder="Share your thoughts on this product..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">SUBMIT REVIEW</button>
                        </form>
                        <hr class="my-5">
                    @elseif(!$canReview && !$myReview)
                        <div class="text-center p-4 bg-light rounded mb-5">
                            <p class="mb-0 text-muted italic">Purchase this item to leave a review.</p>
                        </div>
                        <hr class="my-5">
                    @endif
                @else
                    <div class="text-center p-4 bg-light rounded mb-5">
                        <p class="mb-2">You must be logged in to share your thoughts.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm px-4">LOGIN TO REVIEW</a>
                    </div>
                    <hr class="my-5">
                @endauth

                @if($myReview)
                    <h4 class="font-playfair mb-4" style="color: var(--gold-accent);">My Review</h4>
                    <div class="d-flex mb-4 p-3 rounded" style="background-color: #fcfaf8; border: 1px solid #f0e6d6;">
                        <div class="flex-shrink-0"> 
                            <img src="{{ $myReview->user->img_path ? Storage::url($myReview->user->img_path) : asset('storage/profile_photos/default_user.png') }}" class="rounded-circle border border-2" style="width: 64px; height: 64px; object-fit: cover; border-color: var(--gold-accent) !important;">
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mt-0 fw-bold mb-0">{{ $myReview->user->name }} <span class="badge bg-dark ms-2 small">YOU</span></h5>
                                
                                <div class="d-flex align-items-center gap-3">
                                    <small class="text-muted">{{ $myReview->created_at->format('M d, Y') }}</small>
                                     
                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                        <form action="{{ route('admin.reviews.destroy', $myReview->id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-link text-danger p-0 border-0" 
                                                    onclick="return confirm('Delete this review permanently?')" 
                                                    title="Delete as Admin">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="text-warning my-2">
                                @for($i = 0; $i < $myReview->rating; $i++) <i class="fas fa-star"></i> @endfor
                                @for($i = 5; $i > $myReview->rating; $i--) <i class="far fa-star"></i> @endfor
                            </div>
                            @if($myReview->comment)
                                <p class="mb-2 text-dark">{{ $myReview->comment }}</p>
                            @endif
                            
                            <button class="btn btn-sm btn-link p-0 text-decoration-none text-primary fw-bold" onclick="document.getElementById('edit-my-review').classList.toggle('d-none')">
                                <i class="fas fa-edit me-1"></i> EDIT MY REVIEW
                            </button>

                            <form id="edit-my-review" action="{{ route('reviews.update', $myReview->id) }}" method="POST" class="d-none mt-3 p-3 bg-white border rounded shadow-sm">
                                @csrf
                                @method('PUT')
                                <div class="mb-2">
                                    <select name="rating" class="form-select form-select-sm">
                                        @for($i=1; $i<=5; $i++)
                                            <option value="{{ $i }}" {{ $myReview->rating == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                                        @endfor
                                    </select>
                                </div>
                                <textarea name="comment" class="form-control mb-2" rows="2" placeholder="Your Comment (Optional)">{{ $myReview->comment }}</textarea>
                                <button type="submit" class="btn btn-primary btn-sm px-4">UPDATE REVIEW</button>
                            </form>
                        </div>
                    </div>
                    <hr class="my-5">
                @endif

                <h4 class="font-playfair mb-4" style="color: var(--ink-blue);">Customer Reviews</h4>
                @forelse($otherReviews as $review)
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0"> 
                            <img src="{{ $review->user->img_path ? Storage::url($review->user->img_path) : asset('storage/profile_photos/default_user.png') }}" class="rounded-circle" style="width: 64px; height: 64px; object-fit: cover;">
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mt-0 fw-bold mb-0">{{ $review->user->name }}</h5>
                                
                                <div class="d-flex align-items-center gap-3">
                                    <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                     
                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="m-0 delete-review-form">
                                            @csrf
                                            @method('DELETE') 
                                            <button type="button" class="btn btn-sm btn-link text-danger p-0 border-0 delete-review-btn" title="Delete as Admin">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="text-warning my-2">
                                @for($i = 0; $i < $review->rating; $i++) <i class="fas fa-star"></i> @endfor
                                @for($i = 5; $i > $review->rating; $i--) <i class="far fa-star"></i> @endfor
                            </div>
                            @if($review->comment)
                                <p class="mb-0">{{ $review->comment }}</p>
                            @endif
                        </div>
                    </div>
                    @if(!$loop->last) <hr> @endif
                @empty
                    <div class="text-center py-4 text-muted bg-light rounded">
                        <i class="fas fa-comment-slash fa-2x mb-2"></i>
                        <p class="mb-0">No other reviews for this product yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-review-btn').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('form');
            Swal.fire({
                title: 'Delete Review?',
                text: "This will remove the review from the storefront.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection