@extends('layouts.app')

@section('title', 'Purple Fashion - Elegant Style Redefined')

@section('content')
<!-- Hero Section -->
<section class="hero" style="background: linear-gradient(135deg, #FAF5FF 0%, #E9D8FD 100%); min-height: 90vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge bg-primary mb-3 px-3 py-2" style="background: linear-gradient(135deg, #6B46C1, #9F7AEA) !important;">
                    <i class="fas fa-crown me-1"></i> Premium Collection
                </span>
                <h1 class="display-3 fw-bold mb-4" style="color: #1A0B2E;">
                    Elevate Your <span style="background: linear-gradient(135deg, #6B46C1, #9F7AEA); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Style</span>
                </h1>
                <p class="lead mb-4" style="color: #4A5568;">
                    Discover the latest trends in purple fashion. Quality clothing that speaks elegance and sophistication.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('products') }}" class="btn btn-primary btn-lg">
                        Shop Now <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-lg">
                        Contact Us
                    </a>
                </div>
                
                <div class="row mt-5">
                    <div class="col-4">
                        <h3 class="fw-bold" style="color: #6B46C1;">500+</h3>
                        <p class="text-muted">Products</p>
                    </div>
                    <div class="col-4">
                        <h3 class="fw-bold" style="color: #6B46C1;">10k+</h3>
                        <p class="text-muted">Happy Customers</p>
                    </div>
                    <div class="col-4">
                        <h3 class="fw-bold" style="color: #6B46C1;">4.9★</h3>
                        <p class="text-muted">Rating</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left">
                <img src="{{ asset('images/hero-purple.png') }}" alt="Fashion Model" class="img-fluid" style="max-height: 500px;">
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold" style="color: #1A0B2E;">
                Shop by <span style="background: linear-gradient(135deg, #6B46C1, #9F7AEA); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Categories</span>
            </h2>
            <p class="text-muted">Explore our curated collections</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm text-center p-4" style="border-radius: 20px; transition: all 0.3s; cursor: pointer;">
                    <div class="category-icon mb-3">
                        <i class="fas fa-tshirt fa-3x" style="color: #6B46C1;"></i>
                    </div>
                    <h5 class="mb-1">Men's Fashion</h5>
                    <small class="text-muted">120+ items</small>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm text-center p-4" style="border-radius: 20px; transition: all 0.3s; cursor: pointer;">
                    <div class="category-icon mb-3">
                        <i class="fas fa-female fa-3x" style="color: #9F7AEA;"></i>
                    </div>
                    <h5 class="mb-1">Women's Fashion</h5>
                    <small class="text-muted">250+ items</small>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm text-center p-4" style="border-radius: 20px; transition: all 0.3s; cursor: pointer;">
                    <div class="category-icon mb-3">
                        <i class="fas fa-child fa-3x" style="color: #B794F4;"></i>
                    </div>
                    <h5 class="mb-1">Kids Wear</h5>
                    <small class="text-muted">80+ items</small>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card border-0 shadow-sm text-center p-4" style="border-radius: 20px; transition: all 0.3s; cursor: pointer;">
                    <div class="category-icon mb-3">
                        <i class="fas fa-shoe-prints fa-3x" style="color: #D6BCFA;"></i>
                    </div>
                    <h5 class="mb-1">Footwear</h5>
                    <small class="text-muted">60+ items</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="featured py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold" style="color: #1A0B2E;">
                Featured <span style="background: linear-gradient(135deg, #6B46C1, #9F7AEA); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Products</span>
            </h2>
            <p class="text-muted">Our handpicked just for you</p>
        </div>
        <div class="row g-4">
            @forelse($featuredProducts ?? [] as $product)
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden; transition: all 0.3s;">
                    <div class="position-relative overflow-hidden" style="height: 250px;">
                        <img src="{{ $product->images && count($product->images) > 0 ? asset('storage/' . $product->images[0]) : 'https://via.placeholder.com/300x250/6B46C1/FFFFFF?text=Purple+Fashion' }}" 
                             class="card-img-top w-100 h-100" 
                             alt="{{ $product->name }}"
                             style="object-fit: cover; transition: transform 0.5s;">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge" style="background: linear-gradient(135deg, #6B46C1, #9F7AEA);">New</span>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h6 class="card-title">{{ Str::limit($product->name, 30) }}</h6>
                        <p class="text-muted small">{{ $product->brand_name }}</p>
                        <div class="price mb-2">
                            <span class="h5 fw-bold" style="color: #6B46C1;">${{ number_format($product->price, 2) }}</span>
                        </div>
                        <button class="btn btn-primary btn-sm w-100 add-to-cart" data-id="{{ $product->id }}" style="border-radius: 50px;">
                            <i class="fas fa-shopping-bag"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">No featured products available.</div>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('products') }}" class="btn btn-primary btn-lg px-5">
                View All Products <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Promo Banner -->
<section class="promo py-5" style="background: linear-gradient(135deg, #6B46C1, #9F7AEA);">
    <div class="container">
        <div class="row align-items-center text-center text-white">
            <div class="col-12" data-aos="zoom-in">
                <h2 class="display-5 fw-bold mb-3">Summer Sale is Live!</h2>
                <p class="lead mb-4">Get up to 50% off on selected items. Limited time offer!</p>
                <a href="{{ route('products') }}" class="btn btn-light btn-lg px-5" style="border-radius: 50px;">
                    Shop Now <i class="fas fa-tags ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h3 class="mb-3">Subscribe to Our Newsletter</h3>
                <p class="text-muted mb-4">Get 10% off on your first order and exclusive updates</p>
                <div class="input-group shadow-sm" style="max-width: 500px; margin: 0 auto;">
                    <input type="email" class="form-control form-control-lg" placeholder="Enter your email" style="border-radius: 50px 0 0 50px;">
                    <button class="btn btn-primary btn-lg" type="button" style="border-radius: 0 50px 50px 0;">
                        Subscribe <i class="fas fa-paper-plane ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(107, 70, 193, 0.15) !important;
    }
    
    .category-icon {
        transition: all 0.3s;
    }
    
    .card:hover .category-icon {
        transform: scale(1.1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function() {
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ product_id: this.dataset.id, quantity: 1 })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) location.reload();
            });
        });
    });
</script>
@endpush
@endsection