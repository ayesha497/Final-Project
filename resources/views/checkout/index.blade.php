@extends('layouts.app')

@section('title', 'Checkout - Purple Fashion')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4" style="color: #1A0B2E;" data-aos="fade-right">
        <i class="fas fa-credit-card me-2" style="color: #6B46C1;"></i>Checkout
    </h2>
    
    <div class="row">
        <div class="col-lg-7" data-aos="fade-right">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color: #1A0B2E;">
                        <i class="fas fa-user me-2" style="color: #6B46C1;"></i>Billing Details
                    </h5>
                    
                    <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Full Name *</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD;">
                                        <i class="fas fa-user" style="color: #6B46C1;"></i>
                                    </span>
                                    <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" 
                                           placeholder="John Doe" required style="border-radius: 0 10px 10px 0;">
                                </div>
                                @error('customer_name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address *</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD;">
                                        <i class="fas fa-envelope" style="color: #6B46C1;"></i>
                                    </span>
                                    <input type="email" name="customer_email" class="form-control @error('customer_email') is-invalid @enderror" 
                                           placeholder="hello@example.com" required>
                                </div>
                                @error('customer_email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number *</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD;">
                                        <i class="fas fa-phone" style="color: #6B46C1;"></i>
                                    </span>
                                    <input type="tel" name="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" 
                                           placeholder="+1 234 567 890" required>
                                </div>
                                @error('customer_phone') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold">Delivery Address *</label>
                                <textarea name="customer_address" class="form-control @error('customer_address') is-invalid @enderror" 
                                          rows="3" placeholder="Street address, city, state, zip code" required></textarea>
                                @error('customer_address') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="create_account" id="create_account" value="1" style="border-color: #6B46C1;">
                                    <label class="form-check-label" for="create_account">
                                        <i class="fas fa-user-plus me-1" style="color: #6B46C1;"></i> Create an account for faster checkout
                                    </label>
                                </div>
                            </div>
                            
                            <div id="passwordField" style="display: none;">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD;">
                                            <i class="fas fa-lock" style="color: #6B46C1;"></i>
                                        </span>
                                        <input type="password" name="password" class="form-control" placeholder="Minimum 6 characters">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-5" data-aos="fade-left">
            <div class="card border-0 shadow-sm sticky-top" style="border-radius: 20px; top: 100px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color: #1A0B2E;">
                        <i class="fas fa-shopping-bag me-2" style="color: #6B46C1;"></i>Your Order
                    </h5>
                    
                    <div class="mb-4">
                        @foreach($cart as $item)
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="fw-semibold">{{ $item['name'] }}</span>
                                <br>
                                <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                                @if($item['size'] ?? null)
                                <small class="text-muted"> | Size: {{ $item['size'] }}</small>
                                @endif
                            </div>
                            <span class="fw-semibold">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                        @endforeach
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping</span>
                        <span class="text-success">Free</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tax (10%)</span>
                        <span>${{ number_format($total * 0.1, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <strong class="fs-5">Total</strong>
                        <strong class="fs-5" style="color: #6B46C1;">${{ number_format($total + ($total * 0.1), 2) }}</strong>
                    </div>
                    
                    <!-- Payment Method -->
                    <div class="mb-4 p-3 rounded-3" style="background: linear-gradient(135deg, #FAF5FF, #FFFFFF); border: 1px solid #E9D8FD;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" checked style="border-color: #6B46C1;">
                                <label class="form-check-label fw-semibold" for="cod">
                                    <i class="fas fa-money-bill-wave me-1" style="color: #6B46C1;"></i> Cash on Delivery
                                </label>
                            </div>
                        </div>
                        <p class="small text-muted mt-2 mb-0">Pay when you receive your order. No advance payment required.</p>
                    </div>
                    
                    <button type="submit" form="checkoutForm" class="btn btn-primary w-100 btn-lg" style="border-radius: 50px;">
                        <i class="fas fa-check-circle me-2"></i> Place Order
                    </button>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            By placing order, you agree to our 
                            <a href="#" style="color: #6B46C1;">Terms & Conditions</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('create_account').addEventListener('change', function() {
        document.getElementById('passwordField').style.display = this.checked ? 'block' : 'none';
    });
</script>
@endpush
@endsection