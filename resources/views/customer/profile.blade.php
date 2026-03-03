@extends('layouts.app')

@section('title', 'My Profile - The Saturation Point')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="font-playfair mb-4" style="color: var(--ink-blue);">My Profile</h2>
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4 text-center border-end">
                            <label class="form-label d-block fw-bold text-uppercase small ls-1 mb-3">Profile Photo</label>
                            <div class="mb-3">
                                @if($user->img_path)
                                    <img id="profilePreview" src="{{ Storage::url($user->img_path) }}" 
                                         alt="Profile" 
                                         class="img-thumbnail rounded-circle shadow-sm" 
                                         style="width: 150px; height: 150px; object-fit: cover; border: 3px solid var(--gold-accent);">
                                @else
                                    <img id="profilePreview" src="https://via.placeholder.com/150" 
                                         class="img-thumbnail rounded-circle shadow-sm" 
                                         style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #ccc;">
                                @endif
                            </div>

                            <div>
                                <label for="img_path" class="btn btn-outline-dark btn-sm px-3" style="border-radius: 2px;">
                                    <i class="fas fa-camera me-1"></i> CHANGE PHOTO
                                </label>
                                <input type="file" name="img_path" id="img_path" class="d-none" accept="image/*">
                            </div>
                            
                            @error('img_path') 
                                <div class="text-danger small mt-2 fw-bold">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="col-md-8 ps-md-5">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-uppercase small ls-1">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-uppercase small ls-1 text-muted">Email Address</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly style="background-color: #f8f9fa; color: #6c757d;">
                            </div>

                            <hr class="my-4">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-uppercase small ls-1">New Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-uppercase small ls-1">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-5" style="border-radius: 2px; height: 45px;">
                            UPDATE PROFILE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i> Invalid File</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <p id="modalErrorMessage" class="fs-5 mb-0"></p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="border-radius: 2px;">UNDERSTOOD</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('img_path').onchange = function(evt) {
        const file = this.files[0];
        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        const errorMessage = document.getElementById('modalErrorMessage');
        const preview = document.getElementById('profilePreview');

        if (file) {
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                errorMessage.innerText = "Only image files (JPG, PNG, GIF) are allowed.";
                this.value = ""; 
                errorModal.show();
                return;
            }

            const fileSize = file.size / 1024 / 1024;
            if (fileSize > 2) {
                errorMessage.innerText = "This image is too large (" + fileSize.toFixed(2) + "MB). Please select an image smaller than 2MB.";
                this.value = ""; 
                errorModal.show();
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