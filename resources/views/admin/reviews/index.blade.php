@extends('layouts.app')
@section('title', 'Manage Reviews - The Saturation Point')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0 font-playfair" style="color: var(--ink-blue);">Customer Reviews</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <table class="table table-striped align-middle mb-0" id="reviews-table" style="width: 100%;">
            <thead class="table-light">
                <tr>
                    <th class="ps-4 text-uppercase small fw-bold" style="color: var(--ink-blue);">ID</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Customer</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Product</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Rating</th>
                    <th class="text-uppercase small fw-bold" style="color: var(--ink-blue);">Comment</th>
                    <th class="text-center text-uppercase small fw-bold pe-4" style="color: var(--ink-blue); width: 100px;">Action</th>
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
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        const table = $('#reviews-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.reviews.index") }}',
            columns: [
                { data: 'id', name: 'id', className: 'ps-4' },
                { data: 'user.name', name: 'user.name' },
                { data: 'product.name', name: 'product.name' },
                { data: 'rating', name: 'rating', render: function(data) { 
                    return '<span class="badge" style="background-color: var(--gold-accent); color: var(--ink-blue);">' + data + ' Stars</span>';
                }},
                { data: 'comment', name: 'comment', orderable: false },
                { data: 'id', name: 'action', orderable: false, searchable: false, className: 'text-center pe-4', render: function(data) { 
                    return '<button class="btn btn-danger btn-sm text-nowrap delete-btn d-flex align-items-center justify-content-center w-100" data-id="'+data+'" style="border-radius: 2px; height: 31px;">DELETE</button>';
                }}
            ],
            language: { search: "_INPUT_", searchPlaceholder: "Search reviews..." },
            order: [[0, 'desc']]
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
 
        $('#reviews-table').on('click', '.delete-btn', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Delete Review?',
                text: "This will permanently remove the review from the product page.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/reviews/' + id,
                        type: 'DELETE',
                        success: function(response) {
                            table.draw(false);  
                            showNotification(response.success, response.message);
                        },
                        error: function() {
                            showNotification(false, 'An error occurred while trying to delete.');
                        }
                    });
                }
            })
        });
    });
</script>
@endsection