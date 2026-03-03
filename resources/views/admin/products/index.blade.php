@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0 font-playfair" style="color: var(--ink-blue);">Product Management</h2>
    
    <div class="d-flex align-items-center gap-2">  
        <div class="form-check form-switch m-0 me-2 d-flex align-items-center" style="height: 38px;">
            <input class="form-check-input my-0 me-2" type="checkbox" id="trashToggle" style="cursor: pointer;">
            <label class="form-check-label small fw-bold text-muted text-uppercase mb-0" for="trashToggle" style="cursor: pointer; padding-top: 4px;">View Trash</label>
        </div>
 
        <div>
            <select id="category-filter" class="form-select" style="width: 180px; border-radius: 2px; height: 38px !important; font-size: 0.9rem;">
                <option value="">ALL CATEGORIES</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ strtoupper($cat->name) }}</option>
                @endforeach
            </select>
        </div>
 
        <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data" class="m-0" id="importForm">
            @csrf
            <div class="input-group">
                <input type="file" name="file" id="importFile" class="form-control" style="border-radius: 2px 0 0 2px; height: 38px !important; font-size: 0.9rem; padding-top: 6px;" accept=".csv, .xls, .xlsx" required>
                <button class="btn btn-success text-nowrap d-flex align-items-center" type="submit" style="border-radius: 0 2px 2px 0; height: 38px !important; font-size: 0.9rem; padding: 0 15px;">
                    <i class="fas fa-file-excel me-1"></i> IMPORT
                </button>
            </div>
        </form>
 
        <div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary text-nowrap d-flex align-items-center justify-content-center" style="height: 38px !important; border-radius: 2px; font-size: 0.9rem; padding: 0 15px;">
                <i class="fas fa-plus me-1"></i> ADD NEW
            </a>
        </div>
    </div>
</div>
  
<div class="modal fade" id="importErrorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title"><i class="fas fa-file-excel me-2"></i> Invalid File Type</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <p class="fs-5 mb-2">The file you selected is not supported.</p>
                <p class="text-muted small">Please upload a valid spreadsheet file with one of the following extensions:</p>
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <span class="badge bg-light text-dark border">.xlsx</span>
                    <span class="badge bg-light text-dark border">.xls</span>
                    <span class="badge bg-light text-dark border">.csv</span>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="border-radius: 2px;">UNDERSTOOD</button>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <table class="table table-striped align-middle mb-0" id="products-table" style="width: 100%;">
            <thead>
                <tr>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">ID</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Name</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Brand</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Category</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Price</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Stock</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue); width: 120px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
@include('partials.datatables-scripts') 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        const table = $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.products.index") }}',
                data: function (d) {
                    d.category_id = $('#category-filter').val();
                    d.view_trash = $('#trashToggle').is(':checked') ? '1' : '0';
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'brand', name: 'brand' },
                { data: 'category', name: 'category.name' },
                { data: 'price', name: 'price' },
                { data: 'stock', name: 'stock' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: { search: "_INPUT_", searchPlaceholder: "Search products..." },
            order: [[0, 'desc']]
        });

        $('#category-filter, #trashToggle').on('change', function() {
            table.draw();
        });
 
        function showNotification(success, message) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: success ? 'success' : 'error',
                title: message,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        }
 
        $('#products-table').on('click', '.delete-btn', function() {
            let id = $(this).data('id');
            
            Swal.fire({
                title: 'Move to Trash?',
                text: "This product will be hidden from the storefront.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/products/' + id,
                        type: 'DELETE',
                        success: function(response) {
                            table.draw(false);
                            showNotification(response.success, response.message);
                        }
                    });
                }
            })
        });
 
        $('#products-table').on('click', '.restore-btn', function() {
            let id = $(this).data('id');
            $.ajax({
                url: '/admin/products/' + id + '/restore',
                type: 'POST',
                success: function(response) {
                    if(response.success) {
                        table.draw(false);
                        showNotification(true, response.message);
                    } else { 
                        Swal.fire({
                            icon: 'error',
                            title: 'Restore Failed',
                            text: response.message,
                            confirmButtonColor: '#0f172a'
                        });
                    }
                }
            });
        });
 
        const importInput = document.getElementById('importFile');
        const errorModal = new bootstrap.Modal(document.getElementById('importErrorModal'));

        importInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const fileName = file.name;
                const fileExt = fileName.split('.').pop().toLowerCase();
                if (!['xlsx', 'xls', 'csv'].includes(fileExt)) {
                    errorModal.show();
                    this.value = ""; 
                }
            }
        });
    });
</script>
@endsection