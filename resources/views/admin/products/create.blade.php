@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h4 class="mb-0 font-playfair" style="color: var(--ink-blue);">Create Product Listing</h4>
    </div>
    <div class="card-body p-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                {{-- Added mb-0 to remove the extra bottom space --}}
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row"> 
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price (₱)</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock Quantity</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
                        </div>
                    </div>
                </div>
 
                <div class="col-md-4"> 
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select mb-2" id="categorySelect">
                            <option value="">Select Category...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="new_category" class="form-control" placeholder="Or type new category (e.g. Vintage Pens)" id="newCategoryInput">
                        <div class="form-text small">If you type here, the selection above is ignored.</div>
                    </div>
 
                    <div class="mb-3">
                        <label class="form-label">Brand</label>
                        <input type="text" name="brand" class="form-control" value="{{ old('brand') }}" required>
                    </div>
 
                    <div class="mb-3">
                        <label class="form-label">Main Thumbnail</label>
                        <input type="file" name="img_path" class="form-control" required accept="image/*">
                    </div>
 
                    <div class="mb-3">
                        <label class="form-label">Gallery Images (Multiple)</label>
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                        <div class="form-text">Hold Ctrl to select multiple files.</div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary text-uppercase" style="border-radius: 2px; padding: 6px 20px;">CANCEL</a>
                <button type="submit" class="btn btn-primary text-uppercase" style="border-radius: 2px; padding: 6px 20px;">CREATE PRODUCT</button>
            </div>
        </form>
    </div>
</div>
@endsection