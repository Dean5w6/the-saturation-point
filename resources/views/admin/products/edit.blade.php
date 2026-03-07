@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h4 class="mb-0 font-playfair" style="color: var(--ink-blue);">Edit Product: {{ $product->name }}</h4>
    </div>
    <div class="card-body p-4">

        <form id="editProductForm" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            
            <div class="row"> 
                <div class="col-md-8 pe-md-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase">Description</label>
                        <textarea name="description" class="form-control" rows="5" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-uppercase">Price (₱)</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-uppercase">Stock Quantity</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                        </div>
                    </div>
  
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase border-bottom pb-2 mb-3 d-block w-100">Current Gallery Images</label>
                        <div class="d-flex gap-3 flex-wrap" id="gallery-container">
                            @foreach($product->images as $img)
                                <div class="position-relative gallery-item" id="gallery-item-{{ $img->id }}">
                                    <img src="{{ Storage::url($img->img_path) }}" class="img-thumbnail shadow-sm" style="width: 120px; height: 120px; object-fit: cover; border-radius: 4px;">
                                    <button type="button" 
                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle delete-img-btn" 
                                            data-id="{{ $img->id }}" 
                                            style="transform: translate(30%, -30%); padding: 0; width: 22px; height: 22px; border: 2px solid white; line-height: 1; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                            @if($product->images->isEmpty())
                                <p class="text-muted small fst-italic" id="empty-gallery-msg">No gallery images uploaded.</p>
                            @endif
                        </div>
                    </div>
                </div>
 
                <div class="col-md-4 ps-md-4 border-start"> 
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase">Category</label>
                        
                        <select name="category_id" class="form-select mb-2" id="categorySelect">
                            <option value="">Select Category...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        <input type="text" name="new_category" class="form-control" placeholder="Or type new category (e.g. Vintage Pens)" id="newCategoryInput">
                        <div class="form-text small text-muted">If typed, the selection above is ignored.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase">Brand</label>
                        <input type="text" name="brand" class="form-control" value="{{ old('brand', $product->brand) }}" required>
                    </div>
 
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase d-block mb-3">Main Thumbnail</label>
                        <div class="mb-3 text-center bg-light rounded p-2 border">
                            <img id="main-thumbnail-preview" src="{{ Storage::url($product->img_path) }}" class="shadow-sm rounded" style="width: 100%; height: 200px; object-fit: contain;">
                        </div>
                        <label class="form-label small text-muted fw-bold">Change Thumbnail (Optional)</label>
                        <input type="file" name="img_path" class="form-control form-control-sm" accept="image/*">
                    </div>
 
                    <div class="mb-3 bg-light p-3 rounded border">
                        <label class="form-label small fw-bold text-uppercase">Add More Gallery Images</label>
                        <input type="file" name="images[]" class="form-control form-control-sm mb-2" multiple accept="image/*">
                        <div class="form-text small mb-0"><i class="fas fa-info-circle me-1"></i> Hold Ctrl to select multiple files.</div>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary text-uppercase fw-bold" style="border-radius: 2px; padding: 10px 25px;">Back to Products</a>
                <button type="submit" id="submitBtn" class="btn btn-primary text-uppercase fw-bold shadow-sm" style="border-radius: 2px; padding: 10px 25px;">Update Product</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() { 
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
  
    $('#gallery-container').on('click', '.delete-img-btn', function(e) {
        e.preventDefault();  
        let btn = $(this);
        let imageId = btn.data('id');
        let imageElement = $('#gallery-item-' + imageId);

        Swal.fire({
            title: 'Remove Image?',
            text: "This image will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, remove it'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/products/gallery/' + imageId,
                    type: 'DELETE',
                    success: function(response) {
                        if(response.success) { 
                            imageElement.fadeOut(300, function() { 
                                $(this).remove(); 
                                 
                                if ($('.gallery-item').length === 0) {
                                    $('#gallery-container').html('<p class="text-muted small fst-italic" id="empty-gallery-msg">No gallery images uploaded.</p>');
                                }
                            });
                             
                            Swal.fire({
                                toast: true, position: 'top-end', icon: 'success',
                                title: response.message, showConfirmButton: false, timer: 3000
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong!' });
                    }
                });
            }
        });
    });
 
    $('#editProductForm').on('submit', function(e) {
        e.preventDefault();  
        
        let form = $(this);
        let submitBtn = $('#submitBtn');
        let originalText = submitBtn.html();
         
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>UPDATING...').prop('disabled', true);
 
        let formData = new FormData(this);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',  
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) { 
                submitBtn.html(originalText).prop('disabled', false);

                if(response.success) { 
                    Swal.fire({
                        toast: true, position: 'top-end', icon: 'success',
                        title: response.message, showConfirmButton: false, timer: 3000
                    });
 
                    $('input[type="file"]').val('');
 
                    if(response.main_image) {
                        $('#main-thumbnail-preview').attr('src', response.main_image);
                    }
 
                    if(response.new_gallery && response.new_gallery.length > 0) {
                        $('#empty-gallery-msg').remove();
                        $.each(response.new_gallery, function(index, img) {
                            let newHtml = `
                                <div class="position-relative gallery-item" id="gallery-item-${img.id}">
                                    <img src="${img.url}" class="img-thumbnail shadow-sm" style="width: 120px; height: 120px; object-fit: cover; border-radius: 4px;">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle delete-img-btn" data-id="${img.id}" style="transform: translate(30%, -30%); padding: 0; width: 22px; height: 22px; border: 2px solid white; line-height: 1; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>`;
                            $('#gallery-container').append(newHtml);
                        });
                    }
                }
            },
            error: function(xhr) {
                submitBtn.html(originalText).prop('disabled', false);
                 
                if(xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<ul class="mb-0 text-start" style="font-size: 0.9rem;">';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value[0] + '</li>';
                    });
                    errorHtml += '</ul>';

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorHtml,
                        confirmButtonColor: '#0f172a'
                    });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong on the server.' });
                }
            }
        });
    });
});
</script>
@endsection