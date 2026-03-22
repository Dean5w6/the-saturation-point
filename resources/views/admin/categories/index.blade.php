@extends('layouts.app')
@section('title', 'Manage Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0 font-playfair" style="color: var(--ink-blue);">Category Management</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary d-flex align-items-center text-nowrap" style="height: 38px; border-radius: 2px; font-size: 0.9rem; padding: 0 15px;">
        <i class="fas fa-plus me-1"></i> ADD CATEGORY
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <table class="table table-striped align-middle mb-0" id="categories-table" style="width: 100%;">
            <thead class="table-light">
                <tr>
                    <th class="ps-4 text-uppercase small fw-bold" style="color: var(--ink-blue); width: 80px;">ID</th>
                    <th class="text-uppercase small fw-bold text-center" style="color: var(--ink-blue); width: 100px;">Image</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Name</th>
                    <th class="text-uppercase small fw-bold text-center pe-4" style="color: var(--ink-blue); width: 150px;">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
@include('partials.datatables-scripts')
<script>
    $(function() {
        $('#categories-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.categories.index") }}',
            columns: [
                { data: 'id', name: 'id', className: 'ps-4' },
                { data: 'image', name: 'image', orderable: false, searchable: false, className: 'text-center' },
                { data: 'name', name: 'name', className: 'fw-bold' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center pe-4' }
            ],
            language: { search: "_INPUT_", searchPlaceholder: "Search categories..." },
            order: [[0, 'asc']]  
        });
    });
</script>
@endsection