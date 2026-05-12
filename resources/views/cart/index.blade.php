@extends('layouts.app')

@section('title', 'Shopping Cart - Purple Fashion')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4" style="color: #1A0B2E;" data-aos="fade-right">
        <i class="fas fa-shopping-bag me-2" style="color: #6B46C1;"></i>Shopping Cart
    </h2>
    
    @if(empty($cart))
    <div class="text-center py-5" data-aos="zoom-in">
        <div class="empty-cart">
            <i class="fas fa-shopping-bag fa-5x mb-4" style="color: #D6BCFA;"></i>
            <h3 class="mb-3" style="color: #1A0B2E;">Your cart is empty</h3>
            <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('products') }}" class="btn btn-primary btn-lg" style="border-radius: 50px;">
                <i class="fas fa-store me-2"></i> Continue Shopping
            </a>
        </div>
    </div>
    @else
    <div class="row">
        <!-- Cart Items -->
        <div class="col-lg-8" data-aos="fade-right">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead style="background: #FAF5FF; border-radius: 20px;">
                                <tr>
                                    <th class="p-3">Product</th>
                                    <th class="p-3">Price</th>
                                    <th class="p-3">Quantity</th>
                                    <th class="p-3">Subtotal</th>
                                    <th class="p-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cart as $key => $item)
                                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                                <tr class="border-bottom">
                                    <td class="p-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://via.placeholder.com/80/6B46C1/FFFFFF?text=Product' }}" 
                                                 width="80" height="80" style="object-fit: cover; border-radius: 15px;">
                                            <div>
                                                <h6 class="mb-1 fw-bold">{{ $item['name'] }}</h6>
                                                <div class="small text-muted">
                                                    <span class="badge bg-light text-dark me-1">Size: {{ $item['size'] ?? 'N/A' }}</span>
                                                    <span class="badge bg-light text-dark">Color: {{ $item['color'] ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3 align-middle">${{ number_format($item['price'], 2) }}</td>
                                    <td class="p-3 align-middle">
                                        <div class="input-group" style="width: 120px;">
                                            <button class="btn btn-outline-secondary decrement" data-key="{{ $key }}" type="button" style="border-radius: 10px 0 0 10px;">-</button>
                                            <input type="number" class="form-control text-center quantity-input" data-key="{{ $key }}" value="{{ $item['quantity'] }}" min="1" style="border-radius: 0;">
                                            <button class="btn btn-outline-secondary increment" data-key="{{ $key }}" type="button" style="border-radius: 0 10px 10px 0;">+</button>
                                        </div>
                                    </td>
                                    <td class="p-3 align-middle fw-bold" style="color: #6B46C1;">${{ number_format($subtotal, 2) }}</td>
                                    <td class="p-3 align-middle">
                                        <button class="btn btn-link text-danger remove-item" data-key="{{ $key }}">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Continue Shopping Link -->
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('products') }}" class="btn btn-outline-primary" style="border-radius: 50px;">
                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                </a>
                
                <!-- Coupon Code -->
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Coupon Code" style="border-radius: 50px 0 0 50px;">
                    <button class="btn btn-outline-primary" type="button" style="border-radius: 0 50px 50px 0;">Apply</button>
                </div>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="col-lg-4" data-aos="fade-left">
            <div class="card border-0 shadow-sm sticky-top" style="border-radius: 20px; top: 100px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color: #1A0B2E;">
                        <i class="fas fa-receipt me-2" style="color: #6B46C1;"></i>Order Summary
                    </h5>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-semibold">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Shipping</span>
                        <span class="fw-semibold text-success">Free</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Tax (10%)</span>
                        <span class="fw-semibold">${{ number_format($total * 0.1, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <strong class="fs-5">Total</strong>
                        <strong class="fs-5" style="color: #6B46C1;">${{ number_format($total + ($total * 0.1), 2) }}</strong>
                    </div>
                    
                    <div class="mb-4 p-3 bg-light rounded-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fas fa-truck" style="color: #6B46C1;"></i>
                            <small class="text-muted">Free shipping on all orders!</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-undo-alt" style="color: #6B46C1;"></i>
                            <small class="text-muted">30 days return policy</small>
                        </div>
                    </div>
                    
                    <a href="{{ route('checkout') }}" class="btn btn-primary w-100 btn-lg" style="border-radius: 50px;">
                        <i class="fas fa-lock me-2"></i> Proceed to Checkout
                    </a>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="fab fa-cc-visa me-1"></i>
                            <i class="fab fa-cc-mastercard me-1"></i>
                            <i class="fab fa-cc-paypal me-1"></i>
                            <i class="fab fa-cc-amex"></i>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
    // Update quantity
    document.querySelectorAll('.quantity-input').forEach(input => {
        function updateQuantity(key, quantity) {
            fetch('{{ route("cart.update") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ key: key, quantity: quantity })
            })
            .then(res => res.json())
            .then(data => { if(data.success) location.reload(); });
        }
        
        input.addEventListener('change', function() {
            updateQuantity(this.dataset.key, this.value);
        });
        
        // Increment button
        const incrementBtn = input.parentElement.querySelector('.increment');
        if(incrementBtn) {
            incrementBtn.addEventListener('click', () => {
                input.value = parseInt(input.value) + 1;
                updateQuantity(input.dataset.key, input.value);
            });
        }
        
        // Decrement button
        const decrementBtn = input.parentElement.querySelector('.decrement');
        if(decrementBtn) {
            decrementBtn.addEventListener('click', () => {
                if(parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                    updateQuantity(input.dataset.key, input.value);
                }
            });
        }
    });
    
    // Remove item
    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function() {
            if(confirm('Remove this item from cart?')) {
                fetch('{{ route("cart.remove") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ key: this.dataset.key })
                })
                .then(res => res.json())
                .then(data => { if(data.success) location.reload(); });
            }
        });
    });
</script>
@endpush
@endsection