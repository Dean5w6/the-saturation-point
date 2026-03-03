@extends('layouts.app')
@section('title', 'My Orders - The Saturation Point')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-playfair mb-0" style="color: var(--ink-blue);">My Order History</h2>
    
    <form action="{{ route('orders.history') }}" method="GET" class="d-flex gap-2">
        <select name="status" class="form-select form-select-sm" style="width: 200px; border-radius: 2px;">
            <option value="">ALL ORDERS</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>PENDING</option>
            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>SHIPPED</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>COMPLETED</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>CANCELLED</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm px-4" style="border-radius: 2px;">FILTER</button>
    </form>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Order ID</th>
                    <th>Items Purchased</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="ps-4 fw-bold text-muted">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <ul class="list-unstyled mb-0 small">
                            @foreach($order->items as $item)
                                <li><i class="fas fa-pen-nib me-1" style="color: var(--gold-accent);"></i> {{ $item->product->name ?? 'Unknown' }} (x{{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                        @php
                            $badgeColor = match($order->status) {
                                'pending'   => '#17a2b8',
                                'shipped'   => '#0d6efd',
                                'completed' => '#c6a87c', 
                                'cancelled' => '#dc3545',
                                default     => '#6c757d'
                            };
                        @endphp
                        <span class="badge text-uppercase" style="background-color: {{ $badgeColor }}; letter-spacing: 1px; font-size: 0.7rem; border-radius: 2px;">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="text-end pe-4 fw-bold" style="color: var(--ink-blue);">₱{{ number_format($order->total_price, 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted italic">
                        No orders found in your history.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
@endsection