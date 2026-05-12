<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Purple Fashion - Elegant Style')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        :root {
            --purple-primary: #6B46C1;
            --purple-dark: #553C9A;
            --purple-light: #9F7AEA;
            --purple-bg: #FAF5FF;
            --white: #FFFFFF;
            --gray-light: #F7FAFC;
            --gray-text: #4A5568;
        }
        
        body {
            background: var(--white);
            color: var(--gray-text);
        }
        
        /* Navbar Styles */
        .navbar {
            background: var(--white);
            box-shadow: 0 2px 20px rgba(107, 70, 193, 0.08);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 4px 30px rgba(107, 70, 193, 0.15);
        }
        
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--purple-primary) 0%, var(--purple-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }
        
        .nav-link {
            color: var(--gray-text) !important;
            font-weight: 600;
            margin: 0 0.5rem;
            transition: all 0.3s;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--purple-primary) !important;
            transform: translateY(-2px);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -5px;
            left: 50%;
            background: linear-gradient(135deg, var(--purple-primary), var(--purple-light));
            transition: all 0.3s;
            transform: translateX(-50%);
            border-radius: 10px;
        }
        
        .nav-link:hover::after {
            width: 80%;
        }
        
        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, var(--purple-primary) 0%, var(--purple-dark) 100%);
            border: none;
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(107, 70, 193, 0.2);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(107, 70, 193, 0.3);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--purple-primary);
            color: var(--purple-primary);
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, var(--purple-primary), var(--purple-dark));
            border-color: transparent;
            transform: translateY(-2px);
        }
        
        /* Cart Badge */
        .cart-icon {
            position: relative;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -12px;
            background: linear-gradient(135deg, #F093FB 0%, #F5576C 100%);
            color: white;
            border-radius: 50%;
            padding: 3px 7px;
            font-size: 11px;
            font-weight: bold;
            box-shadow: 0 2px 10px rgba(245, 87, 108, 0.4);
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1A0B2E 0%, #2D1B4E 100%);
            color: #D6BCFA;
            padding: 4rem 0 2rem;
            margin-top: 4rem;
        }
        
        .footer h5 {
            color: white;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }
        
        .footer a {
            color: #D6BCFA;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .footer a:hover {
            color: var(--purple-light);
            transform: translateX(5px);
            display: inline-block;
        }
        
        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            background: linear-gradient(135deg, var(--purple-primary), var(--purple-light));
            transform: translateY(-3px);
        }
        
        /* Alert Messages */
        .alert {
            position: fixed;
            top: 90px;
            right: 20px;
            z-index: 9999;
            min-width: 320px;
            animation: slideInRight 0.5s ease;
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        /* Scroll to top button */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--purple-primary), var(--purple-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(107, 70, 193, 0.3);
            z-index: 999;
        }
        
        .scroll-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .scroll-top:hover {
            transform: translateY(-5px);
        }
    </style>
    
    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-crown me-2"></i>Purple Fashion
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="fas fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('products') }}">
                        <i class="fas fa-store me-1"></i>Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        <i class="fas fa-envelope me-1"></i>Contact
                    </a>
                </li>
            </ul>
            
            <div class="d-flex gap-3">
                <a href="{{ route('cart') }}" class="btn btn-outline-primary position-relative cart-icon">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="cart-count">
                        {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
                    </span>
                </a>
                
                <a href="{{ route('admin.login') }}" class="btn btn-primary">
                    <i class="fas fa-user-shield me-1"></i> Admin
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main style="margin-top: 80px;">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5><i class="fas fa-crown me-2"></i>Purple Fashion</h5>
                <p class="mt-3">Your premier destination for elegant fashion. Quality clothing, exclusive designs, and exceptional service.</p>
                <div class="social-links mt-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
            
            <div class="col-md-2">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ url('/') }}">Home</a></li>
                    <li class="mb-2"><a href="{{ route('products') }}">Products</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h5>Customer Service</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#">Shipping Policy</a></li>
                    <li class="mb-2"><a href="#">Returns & Exchanges</a></li>
                    <li class="mb-2"><a href="#">FAQ</a></li>
                    <li class="mb-2"><a href="#">Size Guide</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h5>Contact Info</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Purple St, NY</li>
                    <li class="mb-2"><i class="fas fa-phone me-2"></i> +1 234 567 890</li>
                    <li class="mb-2"><i class="fas fa-envelope me-2"></i> hello@purplefashion.com</li>
                </ul>
            </div>
        </div>
        
        <hr class="mt-4" style="border-color: rgba(255,255,255,0.1);">
        <div class="text-center mt-3">
            <p class="mb-0">&copy; {{ date('Y') }} Purple Fashion. All rights reserved. | Designed with <i class="fas fa-heart text-danger"></i> by Purple Team</p>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<div class="scroll-top" id="scrollTop">
    <i class="fas fa-arrow-up"></i>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init({
        duration: 1000,
        once: true,
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        const scrollBtn = document.getElementById('scrollTop');
        
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
            scrollBtn.classList.add('show');
        } else {
            navbar.classList.remove('scrolled');
            scrollBtn.classList.remove('show');
        }
    });
    
    // Scroll to top
    document.getElementById('scrollTop').addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Auto hide alerts
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.remove();
        });
    }, 5000);
</script>

@stack('scripts')
</body>
</html>