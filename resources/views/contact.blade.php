@extends('layouts.app')

@section('title', 'Contact Us - Purple Fashion')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <h2 class="fw-bold mb-3" style="color: #1A0B2E;">Get In Touch</h2>
        <p class="text-muted">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
    </div>
    
    <div class="row g-4">
        <!-- Contact Info Cards -->
        <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
            <div class="card border-0 shadow-sm text-center p-4 h-100" style="border-radius: 20px;">
                <div class="mb-3">
                    <div class="mx-auto d-flex align-items-center justify-content-center rounded-circle" 
                         style="width: 70px; height: 70px; background: linear-gradient(135deg, #FAF5FF, #E9D8FD);">
                        <i class="fas fa-map-marker-alt fa-2x" style="color: #6B46C1;"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-2">Visit Us</h5>
                <p class="text-muted mb-0">123 Purple Fashion Street<br>New York, NY 10001</p>
            </div>
        </div>
        
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-0 shadow-sm text-center p-4 h-100" style="border-radius: 20px;">
                <div class="mb-3">
                    <div class="mx-auto d-flex align-items-center justify-content-center rounded-circle" 
                         style="width: 70px; height: 70px; background: linear-gradient(135deg, #FAF5FF, #E9D8FD);">
                        <i class="fas fa-phone-alt fa-2x" style="color: #6B46C1;"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-2">Call Us</h5>
                <p class="text-muted mb-0">+1 (234) 567-890<br>+1 (234) 567-891</p>
            </div>
        </div>
        
        <div class="col-lg-4" data-aos="fade-left" data-aos-delay="300">
            <div class="card border-0 shadow-sm text-center p-4 h-100" style="border-radius: 20px;">
                <div class="mb-3">
                    <div class="mx-auto d-flex align-items-center justify-content-center rounded-circle" 
                         style="width: 70px; height: 70px; background: linear-gradient(135deg, #FAF5FF, #E9D8FD);">
                        <i class="fas fa-envelope fa-2x" style="color: #6B46C1;"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-2">Email Us</h5>
                <p class="text-muted mb-0">hello@purplefashion.com<br>support@purplefashion.com</p>
            </div>
        </div>
    </div>
    
    <div class="row mt-5" data-aos="fade-up">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-sm" style="border-radius: 30px;">
                <div class="card-body p-4 p-md-5">
                    <h4 class="fw-bold mb-4" style="color: #1A0B2E;">
                        <i class="fas fa-paper-plane me-2" style="color: #6B46C1;"></i>Send us a Message
                    </h4>
                    
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Your Name *</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD;">
                                        <i class="fas fa-user" style="color: #6B46C1;"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}" placeholder="John Doe" required>
                                </div>
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address *</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD;">
                                        <i class="fas fa-envelope" style="color: #6B46C1;"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}" placeholder="hello@example.com" required>
                                </div>
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold">Message *</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #FAF5FF; border-color: #E9D8FD; align-items: flex-start; padding-top: 12px;">
                                        <i class="fas fa-comment" style="color: #6B46C1;"></i>
                                    </span>
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" 
                                              rows="5" placeholder="How can we help you?" required>{{ old('message') }}</textarea>
                                </div>
                                @error('message') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg px-5" style="border-radius: 50px;">
                                    <i class="fas fa-paper-plane me-2"></i> Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Map Section -->
    <div class="row mt-5" data-aos="fade-up">
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1x3024.2219901290355!2d-74.00369368400567!3d40.71312937933085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a316bb2eced%3A0x6b3d4f7b8b5b4b5b!2sNew%20York%2C%20NY!5e0!3m2!1sen!2sus!4v1644262073846!5m2!1sen!2sus" 
                    width="100%" 
                    height="350" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .contact-card:hover {
        transform: translateY(-10px);
        transition: all 0.3s;
    }
</style>
@endpush
@endsection