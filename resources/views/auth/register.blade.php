@extends('layouts.app')

@section('title', 'Register - The Saturation Point')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-white text-center py-4">
                <h3 class="mb-0" style="color: var(--ink-blue);">Join the Club</h3>
                <p class="text-muted small mb-0">Begin your collection journey</p>
            </div>
            <div class="card-body p-5"> 
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                     
                    <div class="text-center mb-4">
                        <div class="d-inline-block position-relative">
                            <img id="registerPreview" 
                                 src="https://via.placeholder.com/150?text=Upload" 
                                 class="rounded-circle shadow-sm object-fit-cover" 
                                 style="width: 120px; height: 120px; border: 3px solid var(--gold-accent); cursor: pointer;"
                                 onclick="document.getElementById('img_path').click();">
                            
                            <div class="position-absolute bottom-0 end-0 bg-white rounded-circle border shadow-sm p-1" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-camera text-muted small"></i>
                            </div>
                        </div>
                        <p class="text-muted small mt-2">Tap to upload profile photo</p>
                         
                        <input type="file" name="img_path" id="img_path" class="d-none" accept="image/*">
                        @error('img_path') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
 
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
 
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
 
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Register Account</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3 bg-light">
                <span class="text-muted">Already have an account?</span>
                <a href="{{ route('login') }}" style="color: var(--ink-blue); font-weight: bold;">Sign In</a>
            </div>
        </div>
    </div>
</div>
 
<div class="modal fade" id="regErrorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white border-0 py-2">
                <small class="modal-title fw-bold"><i class="fas fa-exclamation-circle me-1"></i> Invalid File</small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-3">
                <p id="regErrorMessage" class="mb-0 small"></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('img_path').onchange = function(evt) {
        const file = this.files[0];
        const preview = document.getElementById('registerPreview');
        const modal = new bootstrap.Modal(document.getElementById('regErrorModal'));
        const msg = document.getElementById('regErrorMessage');

        if (file) { 
            if (!file.type.match('image.*')) {
                msg.innerText = "Please select a valid image file (JPG, PNG, GIF, etc).";
                this.value = "";
                modal.show();
                return;
            }
 
            if (file.size > 2 * 1024 * 1024) {
                msg.innerText = "Image is too large. Please keep it under 2MB.";
                this.value = "";
                modal.show();
                return;
            } 

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    };
</script>
@endsection