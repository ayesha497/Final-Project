@extends('layouts.app')

@section('title', $product->name . ' - Purple Fashion')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" data-aos="fade-down">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #6B46C1;">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products') }}" style="color: #6B46C1;">Products</a></li>
            <li class="breadcrumb-item active" style="color: #1A0B2E;">{{ Str::limit($product->name, 30) }}</li>
        </ol>
    </nav>
    
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6" data-aos="fade-right">
            <div class="card border-0 shadow-sm" style="border-radius: 30px; overflow: hidden;">
                                <div class="position-relative">
                    @if($product->images && count($product->images) > 0)
                    <img src="{{ asset('storage/' . $product->images[0]) }}" 
                         id="mainImage"
                         class="img-fluid w-100" 
                         alt="{{ $product->name }}"
                         style="height: 500px; object-fit: cover;">
                    @else
                    <img src="https://via.placeholder.com/600x500/6B46C1/FFFFFF?text=Purple+Fashion" 
                         id="mainImage"
                         class="img-fluid w-100" 
                         alt="{{ $product->name }}"
                         style="height: 500px; object-fit: cover;">
                    @endif
                </div>
                @if($product->images && count($product->images) > 1)
                <div class="p-3 bg-light">
                    <div class="row g-2">
                        @foreach($product->images as $index => $image)
                        <div class="col-3">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 class="img-fluid rounded thumb-img" 
                                 style="height: 80px; width: 100%; object-fit: cover; cursor: pointer;"
                                 data-image="{{ asset('storage/' . $image) }}">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Product Details -->
        <div class="col-md-6" data-aos="fade-left">
            <div class="ps-lg-4">
                <span class="badge mb-3 px-3 py-2" style="background: linear-gradient(135deg, #6B46C1, #9F7AEA);">
                    {{ $product->category }}
                </span>
                <h1 class="display-6 fw-bold mb-2" style="color: #1A0B2E;">{{ $product->name }}</h1>
                <p class="text-muted mb-3">
                    <i class="fas fa-building me-1"></i> Brand: {{ $product->brand_name }}
                </p>
                
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="d-flex">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star-half-alt text-warning"></i>
                    </div>
                    <span class="text-muted">(124 reviews)</span>
                </div>
                
                <div class="mb-4">
                    <span class="display-5 fw-bold" style="color: #6B46C1;">${{ number_format($product->price, 2) }}</span>
                    @if($product->price > 100)
                    <span class="text-muted text-decoration-line-through ms-2">${{ number_format($product->price * 1.3, 2) }}</span>
                    <span class="badge bg-success ms-2">Save 30%</span>
                    @endif
                </div>
                
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Select Size</h6>
                    <div class="d-flex gap-2 flex-wrap">
                        @foreach($product->sizes as $size)
                        <div class="form-check">
                            <input class="form-check-input size-option" type="radio" name="size" value="{{ $size }}" id="size_{{ $size }}">
                            <label class="form-check-label btn btn-outline-secondary px-3 py-2" for="size_{{ $size }}" style="border-radius: 10px;">
                                {{ $size }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Select Color</h6>
                    <select class="form-select w-50" id="color" style="border-radius: 10px;">
                        <option value="{{ $product->color }}">{{ $product->color }}</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Quantity</h6>
                    <div class="d-flex align-items-center gap-3">
                        <div class="input-group" style="width: 130px;">
                            <button class="btn btn-outline-secondary decrement" type="button" style="border-radius: 10px 0 0 10px;">-</button>
                            <input type="number" id="quantity" class="form-control text-center" value="1" min="1" style="border-radius: 0;">
                            <button class="btn btn-outline-secondary increment" type="button" style="border-radius: 0 10px 10px 0;">+</button>
                        </div>
                        <span class="text-muted">Available in stock</span>
                    </div>
                </div>
                
                <div class="d-flex gap-3 mb-4">
                    <button class="btn btn-primary btn-lg add-to-cart flex-grow-1" data-id="{{ $product->id }}" style="border-radius: 50px;">
                        <i class="fas fa-shopping-bag me-2"></i> Add to Cart
                    </button>
                    <button class="btn btn-outline-primary btn-lg" style="border-radius: 50px; width: 60px;">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                
                <div class="border-top pt-4">
                    <div class="d-flex gap-4 mb-3">
                        <div><i class="fas fa-truck me-1" style="color: #6B46C1;"></i> Free Shipping</div>
                        <div><i class="fas fa-undo-alt me-1" style="color: #6B46C1;"></i> 30 Days Returns</div>
                        <div><i class="fas fa-shield-alt me-1" style="color: #6B46C1;"></i> Secure Payment</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Product Description -->
    <div class="row mt-5" data-aos="fade-up">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <ul class="nav nav-tabs mb-4" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description" style="color: #6B46C1;">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#details" style="color: #6B46C1;">Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews" style="color: #6B46C1;">Reviews</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="description">
                            <p class="lead">{{ $product->description }}</p>
                        </div>
                        <div class="tab-pane fade" id="details">
                            <table class="table">
                                <tr><th>Brand</th><td>{{ $product->brand_name }}</td></tr>
                                <tr><th>Category</th><td>{{ $product->category }}</td></tr>
                                <tr><th>Color</th><td>{{ $product->color }}</td></tr>
                                <tr><th>Sizes Available</th><td>{{ implode(', ', $product->sizes) }}</td></tr>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="reviews">
                            <p class="text-muted">No reviews yet. Be the first to review this product!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
    @if($relatedProducts->count())
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="fw-bold mb-4" style="color: #1A0B2E;">You May Also Like</h3>
        </div>
        @foreach($relatedProducts as $related)
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
                <img src="{{ $related->images && count($related->images) > 0 ? asset('storage/' . $related->images[0]) : 'https://via.placeholder.com/200/6B46C1/FFFFFF?text=Purple' }}" 
                     class="card-img-top" style="height: 200px; object-fit: cover; border-radius: 20px 20px 0 0;">
                <div class="card-body text-center">
                    <h6>{{ Str::limit($related->name, 25) }}</h6>
                    <p class="text-primary fw-bold">${{ number_format($related->price, 2) }}</p>
                    <a href="{{ route('product.show', $related->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 50px;">View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

@push('styles')
<style>
    .thumb-img {
        transition: all 0.3s;
        border: 2px solid transparent;
    }
    .thumb-img:hover {
        border-color: #6B46C1;
        transform: scale(1.05);
    }
    .nav-tabs .nav-link {
        border: none;
        font-weight: 600;
    }
    .nav-tabs .nav-link.active {
        color: #6B46C1;
        border-bottom: 3px solid #6B46C1;
        background: transparent;
    }
    .breadcrumb-item a:hover {
        color: #9F7AEA !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Quantity increment/decrement
    const quantityInput = document.getElementById('quantity');
    document.querySelector('.increment').addEventListener('click', () => {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });
    document.querySelector('.decrement').addEventListener('click', () => {
        if(parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });
    
    // Thumbnail image change
    document.querySelectorAll('.thumb-img').forEach(img => {
        img.addEventListener('click', function() {
            document.getElementById('mainImage').src = this.dataset.image;
        });
    });
    
    // Add to cart
    document.querySelector('.add-to-cart').addEventListener('click', function() {
        const size = document.querySelector('input[name="size"]:checked');
        if(!size) { alert('Please select a size'); return; }
        
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ 
                product_id: this.dataset.id, 
                quantity: document.getElementById('quantity').value,
                size: size.value,
                color: document.getElementById('color').value
            })
        })
        .then(res => res.json())
        .then(data => { if(data.success) location.reload(); });
    });
</script>
@endpush
@endsection