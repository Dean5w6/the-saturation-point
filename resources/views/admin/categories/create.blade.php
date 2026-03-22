@extends('layouts.app')
@section('title', 'Add New Category')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h4 class="mb-0 font-playfair" style="color: var(--ink-blue);">Create Category</h4>
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

                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase">Category Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g., Calligraphy Nibs" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase d-block mb-3">Category Image (Homepage Banner)</label>
                        <div class="mb-3 text-center bg-light rounded p-4 border border-dashed">
                            <img id="cat-preview" src="https://via.placeholder.com/400x200?text=Upload+Image" class="shadow-sm rounded" style="width: 100%; height: 200px; object-fit: cover;">
                        </div>
                        <input type="file" name="img_path" id="img_path" class="form-control" accept="image/png, image/jpeg, image/jpg, image/webp">
                        <div class="form-text small text-muted mt-2">Recommended size: 800x400px. Used on the main storefront.</div>
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary text-uppercase fw-bold" style="border-radius: 2px; padding: 10px 25px;">Cancel</a>
                        <button type="submit" class="btn btn-primary text-uppercase fw-bold shadow-sm" style="border-radius: 2px; padding: 10px 25px;">Create Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('img_path').onchange = function(evt) {
        const [file] = this.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('cat-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    };
</script>
@endsection