@extends('layouts.app')

@section('title', 'Products - Purple Fashion')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3" data-aos="fade-right">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="mb-4" style="color: #1A0B2E;">
                        <i class="fas fa-filter me-2" style="color: #6B46C1;"></i>Filter Products
                    </h5>
                    <form method="GET" action="{{ route('products') }}">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Search</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search products..." style="border-radius: 50px 0 0 50px;">
                                <button type="submit" class="btn btn-primary" style="border-radius: 0 50px 50px 0;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category" class="form-select" style="border-radius: 50px;">
                                <option value="">All Categories</option>
                                @foreach($categories ?? [] as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 mb-2" style="border-radius: 50px;">
                            <i class="fas fa-search me-2"></i>Apply Filters
                        </button>
                        <a href="{{ route('products') }}" class="btn btn-outline-primary w-100" style="border-radius: 50px;">
                            <i class="fas fa-undo-alt me-2"></i>Reset
                        </a>
                    </form>
                </div>
            </div>
            
            <!-- Featured Brands -->
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="mb-3" style="color: #1A0B2E;">
                        <i class="fas fa-tag me-2" style="color: #6B46C1;"></i>Popular Brands
                    </h5>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-light text-dark p-2">Nike</span>
                        <span class="badge bg-light text-dark p-2">Adidas</span>
                        <span class="badge bg-light text-dark p-2">Zara</span>
                        <span class="badge bg-light text-dark p-2">H&M</span>
                        <span class="badge bg-light text-dark p-2">Gucci</span>
                        <span class="badge bg-light text-dark p-2">Prada</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-left">
                <div>
                    <h2 class="fw-bold" style="color: #1A0B2E;">All Products</h2>
                    <p class="text-muted">Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products</p>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" style="border-radius: 50px;">
                        <i class="fas fa-sort me-1"></i> Sort by
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Latest</a></li>
                        <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                        <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                        <li><a class="dropdown-item" href="#">Popularity</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="row g-4">
                @forelse($products as $product)
                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="card border-0 shadow-sm h-100 product-card" style="border-radius: 20px; overflow: hidden; transition: all 0.3s;">
                        <div class="position-relative overflow-hidden" style="height: 260px;">
                            <img src="{{ $product->images && count($product->images) > 0 ? asset('storage/' . $product->images[0]) : 'https://via.placeholder.com/300x260/6B46C1/FFFFFF?text=Purple+Fashion' }}" 
                                 class="card-img-top w-100 h-100" 
                                 alt="{{ $product->name }}"
                                 style="object-fit: cover; transition: transform 0.5s;">
                            <div class="product-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center opacity-0 transition">
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-light btn-sm mx-1" style="border-radius: 50px;">
                                    <i class="fas fa-eye"></i> Quick View
                                </a>
                            </div>
                            @if($product->price < 50)
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge" style="background: linear-gradient(135deg, #F093FB, #F5576C);">SALE</span>
                            </div>
                            @endif
                        </div>
                        <div class="card-body text-center p-3">
                            <h6 class="card-title mb-1">{{ Str::limit($product->name, 35) }}</h6>
                            <p class="text-muted small mb-2">{{ $product->brand_name }}</p>
                            <div class="d-flex justify-content-center gap-1 mb-2">
                                <i class="fas fa-star text-warning fa-sm"></i>
                                <i class="fas fa-star text-warning fa-sm"></i>
                                <i class="fas fa-star text-warning fa-sm"></i>
                                <i class="fas fa-star text-warning fa-sm"></i>
                                <i class="fas fa-star-half-alt text-warning fa-sm"></i>
                            </div>
                            <div class="price mb-2">
                                <span class="h5 fw-bold" style="color: #6B46C1;">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <button class="btn btn-primary btn-sm w-100 add-to-cart" data-id="{{ $product->id }}" style="border-radius: 50px;">
                                <i class="fas fa-shopping-bag me-1"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-search fa-4x mb-3" style="color: #6B46C1;"></i>
                        <h4>No products found!</h4>
                        <p class="text-muted">Try adjusting your search or filter criteria.</p>
                        <a href="{{ route('products') }}" class="btn btn-primary mt-2" style="border-radius: 50px;">Clear Filters</a>
                    </div>
                </div>
                @endforelse
            </div>
            
            <div class="mt-5 d-flex justify-content-center">
                {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(107, 70, 193, 0.15) !important;
    }
    
    .product-card:hover img {
        transform: scale(1.1);
    }
    
    .product-overlay {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .product-card:hover .product-overlay {
        opacity: 1 !important;
    }
    
    .transition {
        transition: all 0.3s ease;
    }
    
    .pagination .page-link {
        color: #6B46C1;
        border-radius: 10px;
        margin: 0 3px;
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #6B46C1, #9F7AEA);
        border-color: transparent;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function() {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Adding...';
            this.disabled = true;
            
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ product_id: this.dataset.id, quantity: 1 })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    this.innerHTML = '<i class="fas fa-check me-1"></i> Added!';
                    setTimeout(() => location.reload(), 1000);
                }
            });
        });
    });
</script>
@endpush
@endsection