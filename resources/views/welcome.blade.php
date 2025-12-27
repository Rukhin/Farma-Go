<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="PharmaCare - Apotek Online Terpercaya">

        <title>PharmaCare - Apotek Online</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* Reset & Base */
            *, *::before, *::after {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
            
            :root {
                --primary: #737ec6;
                --primary-dark: #3e4353;
                --secondary: #1A202C;
                --text: #2D3748;
                --text-light: #718096;
                --bg: #FFFFFF;
                --bg-secondary: #F7FAFC;
                --border: #E2E8F0;
                --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
                --shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                --radius: 8px;
                --radius-sm: 4px;
                --radius-lg: 12px;
                --transition: all 0.2s ease;
                --header-height: 64px;
                --font-sans: 'Instrument Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            }
            
            @media (prefers-color-scheme: dark) {
                :root {
                    --bg: #0F172A;
                    --bg-secondary: #1E293B;
                    --text: #F1F5F9;
                    --text-light: #94A3B8;
                    --border: #334155;
                    --secondary: #F8FAFC;
                    --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.3);
                    --shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
                }
            }
            
            html {
                scroll-behavior: smooth;
            }
            
            body {
                font-family: var(--font-sans);
                background-color: var(--bg);
                color: var(--text);
                line-height: 1.6;
                overflow-x: hidden;
            }
            
            /* Typography */
            h1, h2, h3, h4, h5, h6 {
                font-weight: 600;
                line-height: 1.2;
                margin-bottom: 1rem;
            }
            
            h1 {
                font-size: 3.5rem;
                font-weight: 700;
                letter-spacing: -0.025em;
            }
            
            h2 {
                font-size: 2.5rem;
                letter-spacing: -0.025em;
            }
            
            h3 {
                font-size: 1.875rem;
            }
            
            p {
                margin-bottom: 1rem;
                color: var(--text-light);
            }
            
            a {
                color: var(--primary);
                text-decoration: none;
                transition: var(--transition);
            }
            
            a:hover {
                color: var(--primary-dark);
            }
            
            .text-gradient {
                background: linear-gradient(135deg, var(--primary), #34D399);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            /* Layout */
            .container {
                width: 100%;
                max-width: 1280px;
                margin: 0 auto;
                padding: 0 1.5rem;
            }
            
            .section {
                padding: 5rem 0;
            }
            
            .section-sm {
                padding: 3rem 0;
            }
            
            /* Buttons */
            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.75rem 1.5rem;
                font-weight: 500;
                border-radius: var(--radius);
                transition: var(--transition);
                cursor: pointer;
                border: 2px solid transparent;
                font-size: 1rem;
            }
            
            .btn-primary {
                background-color: var(--primary);
                color: white;
            }
            
            .btn-primary:hover {
                background-color: var(--primary-dark);
                transform: translateY(-2px);
                box-shadow: var(--shadow-lg);
            }
            
            .btn-secondary {
                background-color: transparent;
                color: var(--text);
                border-color: var(--border);
            }
            
            .btn-secondary:hover {
                background-color: var(--bg-secondary);
                transform: translateY(-2px);
            }
            
            /* Header */
            .header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: var(--header-height);
                background-color: var(--bg);
                border-bottom: 1px solid var(--border);
                z-index: 1000;
                transition: var(--transition);
            }
            
            .header.scrolled {
                box-shadow: var(--shadow);
            }
            
            .header-container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                height: 100%;
            }
            
            .logo {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                font-weight: 700;
                font-size: 1.25rem;
                color: var(--text);
            }
            
            .logo-icon {
                width: 32px;
                height: 32px;
                background: linear-gradient(135deg, var(--primary), #34D399);
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
            }
            
            /* Navigation */
            .nav {
                display: flex;
                align-items: center;
                gap: 2rem;
            }
            
            .nav-link {
                color: var(--text-light);
                font-weight: 500;
                position: relative;
                padding: 0.5rem 0;
            }
            
            .nav-link:hover {
                color: var(--text);
            }
            
            .nav-link.active {
                color: var(--primary);
            }
            
            .nav-link.active::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 2px;
                background-color: var(--primary);
                border-radius: 1px;
            }
            
            .mobile-menu-btn {
                display: none;
                background: none;
                border: none;
                color: var(--text);
                cursor: pointer;
                padding: 0.5rem;
            }
            
            /* Hero */
            .hero {
                padding-top: calc(var(--header-height) + 4rem);
                padding-bottom: 6rem;
                text-align: center;
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(52, 211, 153, 0.05) 100%);
            }
            
            .hero h1 {
                margin-bottom: 1.5rem;
                max-width: 800px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .hero-subtitle {
                font-size: 1.25rem;
                max-width: 600px;
                margin: 0 auto 3rem;
                color: var(--text-light);
            }
            
            .hero-buttons {
                display: flex;
                gap: 1rem;
                justify-content: center;
                margin-bottom: 3rem;
            }
            
            /* Features */
            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 2rem;
                margin-top: 3rem;
            }
            
            .feature-card {
                background: var(--bg);
                border-radius: var(--radius-lg);
                padding: 2rem;
                transition: var(--transition);
                border: 1px solid var(--border);
                box-shadow: var(--shadow);
            }
            
            .feature-card:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow-lg);
            }
            
            .feature-icon {
                width: 48px;
                height: 48px;
                background: linear-gradient(135deg, var(--primary), #34D399);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
                color: white;
            }
            
            /* Products Grid */
            .products-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 2rem;
                margin-top: 3rem;
            }
            
            .product-card {
                background: var(--bg);
                border-radius: var(--radius);
                overflow: hidden;
                transition: var(--transition);
                border: 1px solid var(--border);
                box-shadow: var(--shadow);
            }
            
            .product-card:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow-lg);
            }
            
            .product-image {
                width: 100%;
                height: 200px;
                background: linear-gradient(135deg, var(--primary), #34D399);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
            }
            
            .product-content {
                padding: 1.5rem;
            }
            
            .product-price {
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--primary);
                margin-top: 0.5rem;
            }
            
            /* Categories */
            .categories-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1.5rem;
                margin-top: 2rem;
            }
            
            .category-card {
                background: var(--bg);
                border-radius: var(--radius);
                padding: 1.5rem;
                transition: var(--transition);
                border: 1px solid var(--border);
                text-align: center;
            }
            
            .category-card:hover {
                border-color: var(--primary);
                transform: translateY(-2px);
            }
            
            .category-icon {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, var(--primary), #34D399);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                color: white;
            }
            
            /* Services */
            .services-stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 2rem;
                margin-top: 3rem;
                text-align: center;
            }
            
            .stat-item h3 {
                font-size: 2.5rem;
                margin-bottom: 0.5rem;
                color: var(--primary);
            }
            
            /* Footer */
            .footer {
                background: var(--bg-secondary);
                border-top: 1px solid var(--border);
                padding: 4rem 0 2rem;
            }
            
            .footer-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 3rem;
                margin-bottom: 3rem;
            }
            
            .footer-logo {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                font-weight: 700;
                font-size: 1.25rem;
                color: var(--text);
                margin-bottom: 1rem;
            }
            
            .footer-col h4 {
                margin-bottom: 1.5rem;
            }
            
            .footer-links {
                list-style: none;
            }
            
            .footer-links li {
                margin-bottom: 0.75rem;
            }
            
            .footer-links a {
                color: var(--text-light);
            }
            
            .footer-links a:hover {
                color: var(--primary);
            }
            
            .footer-bottom {
                text-align: center;
                padding-top: 2rem;
                border-top: 1px solid var(--border);
                color: var(--text-light);
            }
            
            /* Auth Buttons */
            .auth-buttons {
                display: flex;
                align-items: center;
                gap: 1rem;
            }
            
            /* Cart Badge */
            .cart-badge {
                position: relative;
            }
            
            .cart-count {
                position: absolute;
                top: -8px;
                right: -8px;
                background: var(--primary);
                color: white;
                font-size: 0.75rem;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            /* Mobile Menu */
            .mobile-menu {
                position: fixed;
                top: var(--header-height);
                left: 0;
                right: 0;
                bottom: 0;
                background: var(--bg);
                padding: 2rem;
                transform: translateX(100%);
                transition: transform 0.3s ease;
                z-index: 999;
                overflow-y: auto;
            }
            
            .mobile-menu.active {
                transform: translateX(0);
            }
            
            .mobile-nav {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }
            
            /* Responsive */
            @media (max-width: 768px) {
                h1 {
                    font-size: 2.5rem;
                }
                
                h2 {
                    font-size: 2rem;
                }
                
                .hero-buttons {
                    flex-direction: column;
                    align-items: center;
                }
                
                .nav {
                    display: none;
                }
                
                .mobile-menu-btn {
                    display: block;
                }
                
                .auth-buttons {
                    display: none;
                }
                
                .mobile-auth-buttons {
                    display: flex;
                    flex-direction: column;
                    gap: 1rem;
                    margin-top: 2rem;
                }
                
                .section {
                    padding: 3rem 0;
                }
                
                .features-grid,
                .products-grid,
                .categories-grid {
                    grid-template-columns: 1fr;
                }
            }
            
            @media (max-width: 480px) {
                .container {
                    padding: 0 1rem;
                }
                
                h1 {
                    font-size: 2rem;
                }
                
                h2 {
                    font-size: 1.75rem;
                }
            }
            
            /* Dark mode toggle */
            .theme-toggle {
                background: none;
                border: none;
                color: var(--text-light);
                cursor: pointer;
                padding: 0.5rem;
                border-radius: var(--radius);
                transition: var(--transition);
            }
            
            .theme-toggle:hover {
                background: var(--bg-secondary);
                color: var(--text);
            }
            
            /* Badge */
            .badge {
                display: inline-block;
                padding: 0.25rem 0.75rem;
                background: linear-gradient(135deg, var(--primary), #34D399);
                color: white;
                border-radius: 9999px;
                font-size: 0.875rem;
                font-weight: 500;
                margin-bottom: 1rem;
            }
            
            /* Promo Banner */
            .promo-banner {
                background: linear-gradient(135deg, var(--primary), #34D399);
                color: white;
                padding: 0.5rem;
                text-align: center;
                font-size: 0.875rem;
            }
            
            /* Search Bar */
            .search-container {
                display: flex;
                gap: 0.5rem;
                margin-bottom: 2rem;
            }
            
            .search-input {
                flex: 1;
                padding: 0.75rem 1rem;
                border: 1px solid var(--border);
                border-radius: var(--radius);
                background: var(--bg);
                color: var(--text);
                font-family: var(--font-sans);
            }
            
            .search-input:focus {
                outline: none;
                border-color: var(--primary);
            }
            
            /* Cart Preview */
            .cart-preview {
                position: absolute;
                top: 100%;
                right: 0;
                width: 320px;
                background: var(--bg);
                border: 1px solid var(--border);
                border-radius: var(--radius);
                box-shadow: var(--shadow-lg);
                padding: 1rem;
                z-index: 1000;
                display: none;
            }
            
            .cart-preview.active {
                display: block;
            }
        </style>
    </head>
    <body>
        <!-- Promo Banner -->
        <div class="promo-banner">
            🎉 Gratis ongkir untuk pembelian pertama! • 💊 Konsultasi dengan apoteker gratis • 🚀 Pengiriman cepat 2-4 jam
        </div>

        <!-- Header -->
        <header class="header" id="header">
            <div class="container header-container">
                <a href="/" class="logo">
                    <div class="logo-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    PharmaCare
                </a>
                
                <nav class="nav">
                    <a href="#home" class="nav-link active">Beranda</a>
                    <a href="#products" class="nav-link">Produk</a>
                    <a href="#categories" class="nav-link">Kategori</a>
                    <a href="#services" class="nav-link">Layanan</a>
                    <a href="#about" class="nav-link">Tentang Kami</a>
                    <div class="cart-badge">
                        <span class="cart-count">3</span>
                    </div>
                </nav>
                
                <div class="auth-buttons">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                Daftar
                            </a>
                        @endif
                    @endauth
                    <button class="theme-toggle" id="theme-toggle">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 3V4M12 20V21M4 12H3M6.31412 6.31412L5.5 5.5M17.6859 6.31412L18.5 5.5M6.31412 17.69L5.5 18.5M17.6859 17.69L18.5 18.5M21 12H20M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                
                <button class="mobile-menu-btn" id="mobile-menu-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </header>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu">
            <nav class="mobile-nav">
                <a href="#home" class="nav-link active">Beranda</a>
                <a href="#products" class="nav-link">Produk</a>
                <a href="#categories" class="nav-link">Kategori</a>
                <a href="#services" class="nav-link">Layanan</a>
                <a href="#about" class="nav-link">Tentang Kami</a>
                
                <div class="mobile-auth-buttons">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-secondary">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                Daftar
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        </div>

        <!-- Hero Section -->
        <section id="home" class="hero">
            <div class="container">
                <div class="badge">Apotek Online Terpercaya Sejak 2010</div>
                <h1>Kesehatan Anda, <span class="text-gradient">Prioritas Kami</span></h1>
                <p class="hero-subtitle">
                    Temukan obat yang Anda butuhkan dengan mudah dan cepat. 
                    Konsultasi gratis dengan apoteker kami untuk mendapatkan rekomendasi terbaik.
                </p>
                
                <div class="hero-buttons">
                    <a href="#products" class="btn btn-primary">
                        Belanja Sekarang
                        <svg style="margin-left: 8px;" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#services" class="btn btn-secondary">
                        Konsultasi Gratis
                    </a>
                </div>
                
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Cari obat, vitamin, atau produk kesehatan...">
                    <button class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section id="products" class="section">
            <div class="container">
                <div style="text-align: center; margin-bottom: 3rem;">
                    <h2>Produk Terlaris</h2>
                    <p style="max-width: 600px; margin: 0 auto;">
                        Temukan obat-obatan dan produk kesehatan berkualitas dengan harga terbaik.
                    </p>
                </div>
                
                <div class="products-grid">
                    <div class="product-card">
                        <div class="product-image">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="product-content">
                            <h3>Paracetamol 500mg</h3>
                            <p>Obat penurun demam dan pereda nyeri</p>
                            <div class="product-price">Rp 15.000</div>
                            <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                                + Keranjang
                            </button>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <div class="product-image">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 15V17M6 21H18C19.1046 21 20 20.1046 20 19V13C20 11.8954 19.1046 11 18 11H6C4.89543 11 4 11.8954 4 13V19C4 20.1046 4.89543 21 6 21ZM16 11V7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7V11H16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="product-content">
                            <h3>Vitamin C 1000mg</h3>
                            <p>Suplemen daya tahan tubuh</p>
                            <div class="product-price">Rp 85.000</div>
                            <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                                + Keranjang
                            </button>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <div class="product-image">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="product-content">
                            <h3>Obat Batuk</h3>
                            <p>Sirup pereda batuk berdahak</p>
                            <div class="product-price">Rp 25.000</div>
                            <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                                + Keranjang
                            </button>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <div class="product-image">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="product-content">
                            <h3>Masker Medis</h3>
                            <p>Masker 3-ply box 50 pcs</p>
                            <div class="product-price">Rp 45.000</div>
                            <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                                + Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section id="categories" class="section" style="background: var(--bg-secondary);">
            <div class="container">
                <div style="text-align: center; margin-bottom: 3rem;">
                    <h2>Kategori Produk</h2>
                    <p style="max-width: 600px; margin: 0 auto;">
                        Jelajahi berbagai kategori produk kesehatan kami.
                    </p>
                </div>
                
                <div class="categories-grid">
                    <div class="category-card">
                        <div class="category-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h4>Obat Bebas</h4>
                        <p>Obat tanpa resep dokter</p>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 15V17M6 21H18C19.1046 21 20 20.1046 20 19V13C20 11.8954 19.1046 11 18 11H6C4.89543 11 4 11.8954 4 13V19C4 20.1046 4.89543 21 6 21ZM16 11V7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7V11H16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h4>Vitamin & Suplemen</h4>
                        <p>Nutrisi tambahan untuk tubuh</p>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h4>Alat Kesehatan</h4>
                        <p>Termometer, tensimeter, dll</p>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h4>Perawatan Kulit</h4>
                        <p>Skincare dan produk kecantikan</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="section">
            <div class="container">
                <div style="text-align: center; margin-bottom: 3rem;">
                    <h2>Layanan Kami</h2>
                    <p style="max-width: 600px; margin: 0 auto;">
                        Nikmati berbagai layanan eksklusif untuk kenyamanan berbelanja Anda.
                    </p>
                </div>
                
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 10V3L4 14H11V21L20 10H13Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Konsultasi Apoteker</h3>
                        <p>Konsultasi gratis dengan apoteker berpengalaman melalui chat atau telepon.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 8H19M5 8C3.89543 8 3 7.10457 3 6C3 4.89543 3.89543 4 5 4H19C20.1046 4 21 4.89543 21 6C21 7.10457 20.1046 8 19 8M5 8V18C5 19.1046 5.89543 20 7 20H17C18.1046 20 19 19.1046 19 18V8M9 12H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Pengiriman Cepat</h3>
                        <p>Pengiriman dalam 2-4 jam untuk area Jakarta dan sekitarnya.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 15V17M6 21H18C19.1046 21 20 20.1046 20 19V13C20 11.8954 19.1046 11 18 11H6C4.89543 11 4 11.8954 4 13V19C4 20.1046 4.89543 21 6 21ZM16 11V7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7V11H16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Pembayaran Aman</h3>
                        <p>Berbagai metode pembayaran yang aman dan terpercaya.</p>
                    </div>
                </div>
                
                <div class="services-stats">
                    <div class="stat-item">
                        <h3>50K+</h3>
                        <p>Produk Tersedia</p>
                    </div>
                    
                    <div class="stat-item">
                        <h3>200K+</h3>
                        <p>Pelanggan Puas</p>
                    </div>
                    
                    <div class="stat-item">
                        <h3>24/7</h3>
                        <p>Layanan Konsultasi</p>
                    </div>
                    
                    <div class="stat-item">
                        <h3>98%</h3>
                        <p>Kepuasan Pelanggan</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="section" style="background: var(--bg-secondary);">
            <div class="container">
                <div style="text-align: center; margin-bottom: 3rem;">
                    <h2>Tentang PharmaCare</h2>
                    <p style="max-width: 600px; margin: 0 auto;">
                        Kami adalah apotek online terpercaya yang berkomitmen memberikan pelayanan kesehatan terbaik.
                    </p>
                </div>
                
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Obat Asli</h3>
                        <p>Semua produk dijamin keasliannya dengan sertifikat resmi dari BPOM.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Konsultasi 24/7</h3>
                        <p>Tim apoteker siap membantu Anda kapan saja melalui chat atau telepon.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Pengiriman Kilat</h3>
                        <p>Layanan pengiriman kilat untuk kebutuhan obat darurat.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section-sm">
            <div class="container">
                <div style="text-align: center; background: linear-gradient(135deg, var(--primary), #34D399); border-radius: var(--radius-lg); padding: 4rem 2rem; color: white;">
                    <h2 style="color: white; margin-bottom: 1rem;">Siap Berbelanja?</h2>
                    <p style="color: rgba(255,255,255,0.9); max-width: 600px; margin: 0 auto 2rem;">
                        Daftar sekarang dan dapatkan diskon 20% untuk pembelian pertama!
                    </p>
                    <a href="{{ route('register') }}" class="btn" style="background: white; color: var(--primary);">
                        Daftar Sekarang
                        <svg style="margin-left: 8px;" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="footer-grid">
                    <div>
                        <div class="footer-logo">
                            <div class="logo-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            PharmaCare
                        </div>
                        <p>Apotek Online Terpercaya sejak 2010. Kesehatan Anda adalah prioritas kami.</p>
                    </div>
                    
                    <div>
                        <h4>Produk</h4>
                        <ul class="footer-links">
                            <li><a href="#products">Obat Bebas</a></li>
                            <li><a href="#products">Vitamin & Suplemen</a></li>
                            <li><a href="#products">Alat Kesehatan</a></li>
                            <li><a href="#products">Perawatan Kulit</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4>Layanan</h4>
                        <ul class="footer-links">
                            <li><a href="#services">Konsultasi Apoteker</a></li>
                            <li><a href="#services">Pengiriman Cepat</a></li>
                            <li><a href="#services">Resep Online</a></li>
                            <li><a href="#services">Checkup Gratis</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4>Kontak</h4>
                        <ul class="footer-links">
                            <li>📞 (021) 1234-5678</li>
                            <li>📧 info@pharmacare.com</li>
                            <li>📍 Jl. Kesehatan No. 123, Jakarta</li>
                            <li>⏰ 24/7 Online</li>
                        </ul>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <p>&copy; {{ date('Y') }} PharmaCare. Semua hak dilindungi undang-undang.</p>
                    @if (Route::has('login'))
                        <div style="margin-top: 1rem;">
                            @auth
                                <a href="{{ url('/dashboard') }}" style="color: var(--text-light); margin: 0 0.5rem;">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" style="color: var(--text-light); margin: 0 0.5rem;">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" style="color: var(--text-light); margin: 0 0.5rem;">
                                        Daftar
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </footer>

        <script>
            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
            });
            
            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                    mobileMenu.classList.remove('active');
                }
            });
            
            // Header scroll effect
            const header = document.getElementById('header');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 10) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
            
            // Theme toggle
            const themeToggle = document.getElementById('theme-toggle');
            const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
            
            themeToggle.addEventListener('click', () => {
                const root = document.documentElement;
                const currentTheme = root.style.getPropertyValue('--bg') || getComputedStyle(root).getPropertyValue('--bg');
                
                if (currentTheme === '#FFFFFF' || currentTheme === 'rgb(255, 255, 255)') {
                    // Switch to dark
                    root.style.setProperty('--bg', '#0F172A');
                    root.style.setProperty('--bg-secondary', '#1E293B');
                    root.style.setProperty('--text', '#F1F5F9');
                    root.style.setProperty('--text-light', '#94A3B8');
                    root.style.setProperty('--border', '#334155');
                    root.style.setProperty('--secondary', '#F8FAFC');
                    root.style.setProperty('--shadow', '0 1px 3px 0 rgba(0, 0, 0, 0.3)');
                    root.style.setProperty('--shadow-lg', '0 10px 25px -5px rgba(0, 0, 0, 0.3)');
                } else {
                    // Switch to light
                    root.style.setProperty('--bg', '#FFFFFF');
                    root.style.setProperty('--bg-secondary', '#F7FAFC');
                    root.style.setProperty('--text', '#2D3748');
                    root.style.setProperty('--text-light', '#718096');
                    root.style.setProperty('--border', '#E2E8F0');
                    root.style.setProperty('--secondary', '#1A202C');
                    root.style.setProperty('--shadow', '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)');
                    root.style.setProperty('--shadow-lg', '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)');
                }
            });
            
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                        
                        // Close mobile menu if open
                        mobileMenu.classList.remove('active');
                    }
                });
            });
            
            // Set active nav link based on scroll position
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');
            
            window.addEventListener('scroll', () => {
                let current = '';
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    
                    if (scrollY >= sectionTop - 100) {
                        current = section.getAttribute('id');
                    }
                });
                
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('active');
                    }
                });
            });
            
            // Add to cart functionality
            document.querySelectorAll('.btn-primary').forEach(button => {
                if (button.textContent.includes('Keranjang')) {
                    button.addEventListener('click', function() {
                        const productName = this.closest('.product-card').querySelector('h3').textContent;
                        const productPrice = this.closest('.product-card').querySelector('.product-price').textContent;
                        
                        // Update cart count
                        const cartCount = document.querySelector('.cart-count');
                        let count = parseInt(cartCount.textContent);
                        count++;
                        cartCount.textContent = count;
                        
                        // Show notification
                        alert(`Produk "${productName}" telah ditambahkan ke keranjang!\nHarga: ${productPrice}`);
                        
                        // Add animation to cart icon
                        const cartIcon = document.querySelector('.cart-badge');
                        cartIcon.style.transform = 'scale(1.2)';
                        setTimeout(() => {
                            cartIcon.style.transform = 'scale(1)';
                        }, 300);
                    });
                }
            });
            
            // Search functionality
            const searchInput = document.querySelector('.search-input');
            const searchButton = document.querySelector('.search-container .btn');
            
            searchButton.addEventListener('click', () => {
                const query = searchInput.value.trim();
                if (query) {
                    alert(`Mencari produk: ${query}`);
                    // In a real application, this would redirect to search results page
                }
            });
            
            searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    const query = searchInput.value.trim();
                    if (query) {
                        alert(`Mencari produk: ${query}`);
                        // In a real application, this would redirect to search results page
                    }
                }
            });
            
            // Initialize scroll effect
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            }
            
            // Auto-hide promo banner after 10 seconds
            setTimeout(() => {
                document.querySelector('.promo-banner').style.opacity = '0.7';
            }, 10000);
        </script>
    </body>
</html>