@extends('layouts.app')
@section('title', 'Your Cart - The Saturation Point')

@section('content')
<h2 class="font-playfair mb-4" style="color: var(--ink-blue);">Your Shopping Cart</h2>

@if(count($cart) > 0)
    <div class="row">
        <div class="col-md-9">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" style="width: 50px;">
                                    <input type="checkbox" id="selectAll" class="form-check-input" style="cursor: pointer;">
                                </th>
                                <th>Product</th>
                                <th class="text-end">Price</th>
                                <th style="width: 180px;" class="text-center">Quantity</th>
                                <th class="text-end">Subtotal</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $details)
                                @php 
                                    $subtotal = $details['price'] * $details['quantity']; 
                                @endphp
                                <tr>
                                    <td class="ps-4">
                                        {{-- Added data-subtotal for JS calculation --}}
                                        <input type="checkbox" name="selected_items[]" value="{{ $id }}" 
                                               form="checkout-form" 
                                               class="form-check-input item-checkbox" 
                                               data-subtotal="{{ $subtotal }}"
                                               style="cursor: pointer;">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($details['img_path'])
                                                <img src="{{ Storage::url($details['img_path']) }}" alt="Product" style="width: 50px; height: 50px; object-fit: cover;" class="rounded me-3 border">
                                            @endif
                                            <div>
                                                <span class="fw-bold d-block">{{ $details['name'] }}</span>
                                                <small class="text-muted">In Stock: {{ $details['stock'] }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">₱{{ number_format($details['price'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="m-0 d-flex justify-content-center">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group input-group-sm" style="max-width: 120px;">
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" max="{{ $details['stock'] }}" class="form-control text-center">
                                                <button type="submit" class="btn btn-outline-dark">UPDATE</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-end fw-bold text-success">₱{{ number_format($subtotal, 2) }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST" class="m-0">
                                            @csrf
                                            <button class="btn btn-sm btn-link text-danger text-decoration-none fw-bold">REMOVE</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm sticky-top" style="top: 100px; background-color: var(--ink-blue); color: white;">
                <div class="card-body p-4">
                    <h5 class="border-bottom border-secondary pb-3 mb-4 text-uppercase small ls-1">Summary</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white-50 small">Items Selected:</span>
                        <span id="selected-count" class="small fw-bold">0</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="fs-5">Total</span>
                        {{-- The ID checkout-total allows JS to update this text --}}
                        <span id="checkout-total" class="fs-5 fw-bold" style="color: var(--gold-accent);">₱0.00</span>
                    </div>
                    
                    <form id="checkout-form" action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="submit" id="checkout-btn" class="btn w-100 py-3 fw-bold" 
                                style="background-color: var(--gold-accent); color: var(--ink-blue); border-radius: 2px;" disabled>
                            CHECKOUT SELECTED
                        </button>
                    </form>
                    <p class="text-white-50 small mt-3 text-center" id="checkout-hint">Please select items to proceed.</p>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="text-center py-5">
        <i class="fas fa-shopping-basket fa-4x mb-3 text-muted"></i>
        <h4>Your cart is empty</h4>
        <p class="text-muted">Looks like you haven't added anything to your collection yet.</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3 px-5" style="border-radius: 2px;">START SHOPPING</a>
    </div>
@endif
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectAll = document.getElementById('selectAll');
        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
        const totalDisplay = document.getElementById('checkout-total');
        const countDisplay = document.getElementById('selected-count');
        const checkoutBtn = document.getElementById('checkout-btn');
        const checkoutHint = document.getElementById('checkout-hint');

        function calculateTotal() {
            let total = 0;
            let count = 0;

            itemCheckboxes.forEach(cb => {
                if (cb.checked) { 
                    total += parseFloat(cb.getAttribute('data-subtotal'));
                    count++;
                }
            });
 
            totalDisplay.innerText = '₱' + total.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            countDisplay.innerText = count;
 
            if (count > 0) {
                checkoutBtn.disabled = false;
                checkoutBtn.style.opacity = "1";
                checkoutHint.classList.add('d-none');
            } else {
                checkoutBtn.disabled = true;
                checkoutBtn.style.opacity = "0.5";
                checkoutHint.classList.remove('d-none');
            }
        }
 
        itemCheckboxes.forEach(cb => cb.addEventListener('change', calculateTotal));

        if(selectAll) {
            selectAll.addEventListener('change', function() {
                itemCheckboxes.forEach(cb => cb.checked = this.checked);
                calculateTotal();
            });
        }
 
        calculateTotal();
    });
</script>
@endsection