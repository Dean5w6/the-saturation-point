@extends('layouts.app')
@section('title', 'Manage Orders - The Saturation Point')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0 font-playfair" style="color: var(--ink-blue);">Transaction Management</h2>
     
    <div class="d-flex align-items-center gap-2">
        <label class="small fw-bold text-muted text-uppercase ls-1 mb-0" style="font-size: 0.7rem;">Filter Status:</label>
        <select id="status-filter" class="form-select form-select-sm" style="width: 180px; border-radius: 2px; height: 31px;">
            <option value="">ALL STATUSES</option>
            <option value="pending">PENDING</option>
            <option value="shipped">SHIPPED</option>
            <option value="completed">COMPLETED</option>
            <option value="cancelled">CANCELLED</option>
        </select>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <table class="table table-striped align-middle mb-0" id="orders-table" style="width:100%">
            <thead>
                <tr>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">ID</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Customer</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Items</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Status</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Total</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Date</th>
                    <th class="text-center text-uppercase small fw-bold" style="color: var(--ink-blue); width: 100px;">Action</th>
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
        const table = $('#orders-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.orders.index") }}',
                data: function (d) {
                    d.status = $('#status-filter').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'customer', name: 'user.name' },
                { data: 'items', name: 'items', orderable: false },
                { data: 'status', name: 'status' },
                { data: 'total_price', name: 'total_price' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
            ], 
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search orders...",
                lengthMenu: "Show _MENU_ entries",
            },
            pageLength: 10,
            order: [[0, 'desc']]
        });
 
        $('#status-filter').on('change', function() {
            table.draw();
        });
    });
</script>
@endsection