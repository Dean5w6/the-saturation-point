@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h4 class="mb-0 font-playfair" style="color: var(--ink-blue);">Edit Product: {{ $product->name }}</h4>
    </div>
    <div class="card-body p-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            
            <div class="row"> 
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price (₱)</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock Quantity</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                        </div>
                    </div>
 
                    <div class="mb-3">
                        <label class="form-label">Current Gallery Images</label>
                        <div class="d-flex gap-2 flex-wrap">
                            @foreach($product->images as $img)
                                <img src="{{ Storage::url($img->img_path) }}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                            @endforeach
                            @if($product->images->isEmpty())
                                <p class="text-muted small fst-italic">No gallery images uploaded.</p>
                            @endif
                        </div>
                    </div>
                </div>
 
                <div class="col-md-4"> 
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        
                        <select name="category_id" class="form-select mb-2" id="categorySelect">
                            <option value="">Select Category...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        <input type="text" name="new_category" class="form-control" placeholder="Or type new category (e.g. Vintage Pens)" id="newCategoryInput">
                        <div class="form-text small">If you type here, the selection above is ignored.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Brand</label>
                        <input type="text" name="brand" class="form-control" value="{{ old('brand', $product->brand) }}" required>
                    </div>
 
                    <div class="mb-3">
                        <label class="form-label">Main Thumbnail</label>
                        <div class="mb-2">
                            <img src="{{ Storage::url($product->img_path) }}" class="img-thumbnail" style="width: 100%; height: 200px; object-fit: cover;">
                        </div>
                        <label class="form-label small text-muted">Change Thumbnail (Optional)</label>
                        <input type="file" name="img_path" class="form-control" accept="image/*">
                    </div>
 
                    <div class="mb-3">
                        <label class="form-label">Add More Gallery Images</label>
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                        <div class="form-text">Selected files will be appended to the gallery.</div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary text-uppercase" style="border-radius: 2px; padding: 6px 20px;">CANCEL</a>
                <button type="submit" class="btn btn-primary text-uppercase" style="border-radius: 2px; padding: 6px 20px;">UPDATE PRODUCT</button>
            </div>
        </form>
    </div>
</div>
@endsection