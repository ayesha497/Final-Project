@extends('admin.layouts.app')

@section('title', 'Edit Product')
@section('header', 'Edit Product')

@section('content')
<div class="table-card">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label fw-semibold">Brand Name *</label>
                <div class="input-group">
                    <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD;">
                        <i class="fas fa-building" style="color: #6B46C1;"></i>
                    </span>
                    <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" 
                           value="{{ old('brand_name', $product->brand_name) }}" required>
                </div>
                @error('brand_name') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-6 mb-4">
                <label class="form-label fw-semibold">Product Name *</label>
                <div class="input-group">
                    <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD;">
                        <i class="fas fa-tag" style="color: #6B46C1;"></i>
                    </span>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $product->name) }}" required>
                </div>
                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-6 mb-4">
                <label class="form-label fw-semibold">Category *</label>
                <div class="input-group">
                    <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD;">
                        <i class="fas fa-list" style="color: #6B46C1;"></i>
                    </span>
                    <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                        <option value="">Select Category</option>
                        @foreach($categories ?? [] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-6 mb-4">
                <label class="form-label fw-semibold">Color *</label>
                <div class="input-group">
                    <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD;">
                        <i class="fas fa-palette" style="color: #6B46C1;"></i>
                    </span>
                    <select name="color" class="form-select @error('color') is-invalid @enderror" required>
                        <option value="">Select Color</option>
                        @foreach($colors ?? [] as $col)
                        <option value="{{ $col }}" {{ old('color', $product->color) == $col ? 'selected' : '' }}>{{ $col }}</option>
                        @endforeach
                    </select>
                </div>
                @error('color') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-12 mb-4">
                <label class="form-label fw-semibold">Sizes (Check all that apply) *</label>
                <div class="p-3" style="background: #FAF5FF; border-radius: 15px;">
                    <div class="row">
                        @foreach($sizesOptions ?? [] as $size)
                        <div class="col-md-2 col-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sizes[]" value="{{ $size }}" 
                                       id="size_{{ $size }}" {{ in_array($size, old('sizes', $product->sizes ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="size_{{ $size }}">{{ $size }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @error('sizes') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-12 mb-4">
                <label class="form-label fw-semibold">Description *</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                          rows="5" required>{{ old('description', $product->description) }}</textarea>
                @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-6 mb-4">
                <label class="form-label fw-semibold">Price *</label>
                <div class="input-group">
                    <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD;">$</span>
                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" 
                           value="{{ old('price', $product->price) }}" required>
                </div>
                @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-6 mb-4">
                <label class="form-label fw-semibold">Current Images</label>
                <div class="row g-2">
                    @if($product->images)
                        @foreach($product->images as $image)
                        <div class="col-md-3">
                            <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            
            <div class="col-md-12 mb-4">
                <label class="form-label fw-semibold">Upload New Images</label>
                <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" 
                       multiple accept="image/*">
                <small class="text-muted">Leave empty to keep current images. Upload new to replace all.</small>
                @error('images') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i> Update Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection