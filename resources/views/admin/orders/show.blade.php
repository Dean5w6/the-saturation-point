@extends('layouts.app')
@section('title', 'Manage Order #'.$order->id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-playfair" style="color: var(--ink-blue);">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h2>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Back to Orders</a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white"><strong>Order Items</strong></div>
            <div class="card-body">
                <table class="table">
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }} x ₱{{ number_format($item->price, 2) }}</td>
                        <td class="text-end fw-bold">₱{{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="fw-bold">
                        <td colspan="2" class="text-end">Total:</td>
                        <td class="text-end">₱{{ number_format($order->total_price, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <strong class="text-uppercase small ls-1" style="color: var(--ink-blue);">Order Management</strong>
            </div>
            <div class="card-body">
                <p class="mb-1 small text-muted text-uppercase">Customer</p>
                <p class="fw-bold mb-4">{{ $order->user->name }}</p>

                @if(in_array($order->status, ['completed', 'cancelled']))
                    <div class="alert alert-secondary border-0 text-center py-4">
                        <i class="fas fa-lock mb-2 fa-2x text-muted"></i>
                        <h6 class="text-uppercase fw-bold">Order Locked</h6>
                        <p class="small mb-0">This transaction is marked as <strong>{{ strtoupper($order->status) }}</strong> and cannot be modified.</p>
                    </div>
                @else 
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase ls-1">Change Status</label>
                            <select name="status" class="form-select" required style="border-radius: 2px;">
                                @if($order->status == 'pending')
                                    <option value="pending" selected disabled>PENDING (Current)</option>
                                    <option value="shipped">MARK AS SHIPPED</option>
                                    <option value="cancelled">CANCEL ORDER</option>
                                @elseif($order->status == 'shipped')
                                    <option value="shipped" selected disabled>SHIPPED (Current)</option>
                                    <option value="completed">MARK AS COMPLETED</option>
                                @endif
                            </select>
                            
                            @if($order->status == 'pending')
                                <div class="form-text mt-2 small italic">
                                    <i class="fas fa-info-circle me-1"></i> You must ship the order before completing it.
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="border-radius: 2px; height: 45px;">
                            UPDATE & NOTIFY CUSTOMER
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection