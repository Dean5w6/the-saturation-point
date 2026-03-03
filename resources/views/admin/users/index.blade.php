@extends('layouts.app')
@section('title', 'Manage Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0 font-playfair" style="color: var(--ink-blue);">User Management</h2>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <table class="table table-striped align-middle" id="users-table">
            <thead class="table-light">
                <tr>
                    <th class="ps-4 text-uppercase small fw-bold" style="color: var(--ink-blue);">ID</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Name</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Email</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Role</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Status</th>
                    <th class="text-uppercase small fw-bold pe-4" style="color: var(--ink-blue);">Action</th>
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
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.users.index") }}',
            columns: [
                { data: 'id', name: 'id', className: 'ps-4' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role' },
                { data: 'status', name: 'is_active' }, 
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center pe-4' }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search users...",
            },
            order: [[0, 'desc']]
        });
    });
</script>
@endsection