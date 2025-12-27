<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Apotek POS') }} - Sistem Penjualan Obat</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --primary: #8e9dd6;
                --primary-dark: #0e487e;
                --primary-light: #c889cf;
                --secondary: #1A202C;
                --text: #2D3748;
                --text-light: #718096;
                --bg: #FFFFFF;
                --bg-secondary: #F7FAFC;
                --bg-gradient: linear-gradient(135deg, #f0f7fd 0%, #e7f6fe 100%);
                --border: #E2E8F0;
                --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
                --shadow-lg: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
                --radius: 12px;
                --transition: all 0.3s ease;
                --font-sans: 'Instrument Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            }

            @media (prefers-color-scheme: dark) {
                :root {
                    --bg: #0F172A;
                    --bg-secondary: #1E293B;
                    --text: #F1F5F9;
                    --text-light: #94A3B8;
                    --border: #334155;
                    --bg-gradient: linear-gradient(135deg, #06304e 0%, #05222e 100%);
                }
            }

            body {
                font-family: var(--font-sans);
                background: var(--bg-gradient);
                color: var(--text);
                min-height: 100vh;
                line-height: 1.6;
            }

            /* Animations */
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(2deg); }
                50% { transform: translateY(-20px) rotate(2deg); }
            }

            @keyframes slideIn {
                from { 
                    opacity: 0;
                    transform: translateY(30px) scale(0.95);
                }
                to { 
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            /* Utility Classes */
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            .animate-slide-in {
                animation: slideIn 0.6s ease-out forwards;
            }

            .animate-fade-in {
                animation: fadeIn 0.5s ease-out forwards;
            }

            .text-gradient {
                background: linear-gradient(135deg, var(--primary), #3491d3);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* Background Pattern */
            .bg-pattern {
                position: fixed;
                inset: 0;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2310B981' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                opacity: 0.3;
                z-index: -1;
            }

            /* Floating Elements */
            .floating-element {
                position: fixed;
                z-index: -1;
                opacity: 0.1;
            }

            .floating-element:nth-child(1) {
                top: 10%;
                left: 5%;
                width: 100px;
                height: 100px;
                background: linear-gradient(135deg, var(--primary), #348bd3);
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
                animation: float 8s ease-in-out infinite;
            }

            .floating-element:nth-child(2) {
                bottom: 20%;
                right: 5%;
                width: 150px;
                height: 150px;
                background: linear-gradient(135deg, #345ed3, var(--primary));
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
                animation: float 10s ease-in-out infinite reverse;
            }

            /* Navigation Styles */
            .nav-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid var(--border);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                position: sticky;
                top: 0;
                z-index: 1000;
                transition: var(--transition);
            }

            .dark .nav-container {
                background: rgba(15, 23, 42, 0.95);
                border-bottom-color: rgba(255, 255, 255, 0.1);
            }

            /* Page Header - DIUBAH MENJADI HIJAU SEPERTI KODE KEDUA */
            .page-header {
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                padding: 3rem 2rem;
                position: relative;
                overflow: hidden;
                margin-bottom: 2rem;
            }

            .page-header::before {
                content: '';
                position: absolute;
                inset: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            .page-header-content {
                max-width: 1400px;
                margin: 0 auto;
                position: relative;
                z-index: 2;
            }

            .page-title {
                color: white;
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
                line-height: 1.2;
            }

            .page-subtitle {
                color: rgba(255, 255, 255, 0.9);
                font-size: 1.125rem;
                max-width: 600px;
            }

            .header-decoration {
                position: absolute;
                bottom: -50px;
                right: 50px;
                width: 200px;
                height: 200px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                z-index: 1;
            }

            /* Main Content */
            .main-content-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: var(--radius);
                box-shadow: var(--shadow-lg);
                border: 1px solid rgba(255, 255, 255, 0.2);
                transition: var(--transition);
            }

            .main-content-container:hover {
                box-shadow: 0 25px 50px -12px rgba(16, 109, 185, 0.15);
            }

            .dark .main-content-container {
                background: rgba(15, 23, 42, 0.9);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            /* Footer */
            .footer-container {
                background: rgba(15, 23, 42, 0.95);
                backdrop-filter: blur(10px);
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }

            /* Mobile Responsive */
            @media (max-width: 768px) {
                .mobile-padding {
                    padding-left: 1rem;
                    padding-right: 1rem;
                }
                
                .page-title {
                    font-size: 1.75rem;
                }
                
                .center-menu {
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                }
            }

            /* Menu Styles */
            .desktop-menu {
                display: flex;
                align-items: center;
                gap: 1rem;
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }

            .mobile-menu-toggle {
                display: none;
                background: none;
                border: none;
                color: var(--text);
                font-size: 1.5rem;
                cursor: pointer;
                padding: 0.5rem;
                border-radius: 8px;
                transition: var(--transition);
            }

            .mobile-menu-toggle:hover {
                background: rgba(16, 185, 129, 0.1);
                color: var(--primary);
            }

            .mobile-menu {
                display: none;
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                border-top: 1px solid var(--border);
                border-bottom: 1px solid var(--border);
                padding: 1rem;
                z-index: 999;
                transform: translateY(-100%);
                opacity: 0;
                transition: var(--transition);
            }

            .mobile-menu.active {
                transform: translateY(0);
                opacity: 1;
            }

            .dark .mobile-menu {
                background: rgba(15, 23, 42, 0.98);
                border-color: rgba(255, 255, 255, 0.1);
            }

            .mobile-nav-link {
                display: block;
                padding: 1rem;
                color: var(--text);
                text-decoration: none;
                font-weight: 500;
                border-radius: 8px;
                margin-bottom: 0.5rem;
                transition: var(--transition);
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .mobile-nav-link:hover {
                background: rgba(16, 185, 129, 0.1);
                color: var(--primary);
                transform: translateX(5px);
            }

            .mobile-nav-link i {
                width: 20px;
                text-align: center;
            }

            /* Logo Styles */
            .custom-logo {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                text-decoration: none;
                transition: var(--transition);
            }

            .custom-logo:hover {
                transform: translateY(-2px);
            }

            .custom-logo-icon {
                width: 40px;
                height: 40px;
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.25rem;
            }

            .custom-logo-text {
                display: flex;
                flex-direction: column;
                line-height: 1.2;
            }

            .custom-logo-title {
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--text);
                letter-spacing: -0.5px;
            }

            .custom-logo-subtitle {
                font-size: 0.75rem;
                color: var(--text-light);
                font-weight: 500;
            }

            /* Nav Link Styles */
            .custom-nav-link {
                color: var(--text);
                text-decoration: none;
                font-weight: 500;
                font-size: 0.9375rem;
                padding: 0.5rem 1rem;
                border-radius: 8px;
                transition: var(--transition);
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .custom-nav-link:hover {
                color: var(--primary);
                background: rgba(16, 185, 129, 0.1);
                transform: translateY(-2px);
            }

            .custom-nav-link.active {
                color: var(--primary);
                background: rgba(16, 185, 129, 0.1);
                font-weight: 600;
            }

            /* User Menu */
            .user-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: 600;
                cursor: pointer;
                transition: var(--transition);
                border: 2px solid transparent;
            }

            .user-avatar:hover {
                transform: scale(1.05);
                border-color: var(--primary);
            }

            /* Media Queries for Menu */
            @media (max-width: 768px) {
                .desktop-menu {
                    display: none;
                }
                
                .mobile-menu-toggle {
                    display: block;
                }

                .page-header {
                    padding: 2rem 1rem;
                }

                .page-title {
                    font-size: 1.75rem;
                }

                .page-subtitle {
                    font-size: 1rem;
                }
            }

            @media (max-width: 480px) {
                .custom-logo-title {
                    font-size: 1.25rem;
                }

                .custom-logo-subtitle {
                    font-size: 0.625rem;
                }

                .page-title {
                    font-size: 1.5rem;
                }
            }

            @media (min-width: 769px) {
                .mobile-menu {
                    display: none !important;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased dark:bg-gray-900">
        <!-- Background Pattern -->
        <div class="bg-pattern"></div>
        
        <!-- Floating Elements -->
        <div class="floating-element"></div>
        <div class="floating-element"></div>

        <div class="min-h-screen flex flex-col">
            <!-- Navigation (Sesuai dengan struktur asli) -->
            <nav class="nav-container animate-fade-in">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16 relative">
                        <!-- Logo di kiri -->
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <a href="{{ url('/') }}" class="custom-logo">
                                    <div class="custom-logo-icon">
                                        <i class="fas fa-pills"></i>
                                    </div>
                                    <div class="custom-logo-text">
                                        <span class="custom-logo-title">Farma-Go</span>
                                        <span class="custom-logo-subtitle">Apotek No 1 Indonesia</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Navigation Links di tengah -->
                        <div class="hidden sm:flex desktop-menu">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="custom-nav-link">
                                <i class="fas fa-home"></i>
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            
                            @if(Auth::check())
                                <x-nav-link :href="route('medicines.index')" :active="request()->is('medicines*')" class="custom-nav-link">
                                    <i class="fas fa-capsules"></i>
                                    Obat
                                </x-nav-link>
                                
                                <x-nav-link :href="route('transactions.index')" :active="request()->is('transactions*')" class="custom-nav-link">
                                    <i class="fas fa-shopping-cart"></i>
                                    Transaksi
                                </x-nav-link>
                                
                                <x-nav-link :href="route('reports.stock')" :active="request()->is('reports*')" class="custom-nav-link">
                                    <i class="fas fa-chart-bar"></i>
                                    Laporan
                                </x-nav-link>
                            @endif
                        </div>

                        <!-- Settings Dropdown di kanan -->
                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="user-avatar">
                                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        <i class="fas fa-user mr-2"></i>
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            <i class="fas fa-sign-out-alt mr-2"></i>
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        <!-- Hamburger Menu (Mobile) -->
                        <div class="flex items-center sm:hidden">
                            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile Navigation Menu -->
                <div class="mobile-menu" id="mobileMenu">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="mobile-nav-link">
                            <i class="fas fa-home"></i>
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                        
                        @if(Auth::check())
                            <x-responsive-nav-link :href="route('medicines.index')" :active="request()->is('medicines*')" class="mobile-nav-link">
                                <i class="fas fa-capsules"></i>
                                Obat
                            </x-responsive-nav-link>
                            
                            <x-responsive-nav-link :href="route('transactions.index')" :active="request()->is('transactions*')" class="mobile-nav-link">
                                <i class="fas fa-shopping-cart"></i>
                                Transaksi
                            </x-responsive-nav-link>
                            
                            <x-responsive-nav-link :href="route('reports.stock')" :active="request()->is('reports*')" class="mobile-nav-link">
                                <i class="fas fa-chart-bar"></i>
                                Laporan
                            </x-responsive-nav-link>
                        @endif
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name ?? 'User' }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? 'user@example.com' }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')" class="mobile-nav-link">
                                <i class="fas fa-user"></i>
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="mobile-nav-link">
                                    <i class="fas fa-sign-out-alt"></i>
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading - DIUBAH MENJADI HIJAU SEPERTI KODE KEDUA -->
            @isset($header)
                <header class="page-header animate-slide-in">
                    <div class="page-header-content">
                        <h1 class="page-title">{{ $header }}</h1>
                        @isset($subtitle)
                            <p class="page-subtitle">{{ $subtitle }}</p>
                        @endisset
                    </div>
                    <div class="header-decoration"></div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow py-6 sm:py-8 mobile-padding animate-fade-in">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="main-content-container p-4 sm:p-6 lg:p-8 border border-gray-200/50">
                        {{ $slot }}
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="footer-container border-t border-gray-700 mt-12 py-6 px-4 text-white animate-fade-in">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="text-center md:text-left">
                            <p class="text-sm md:text-base">&copy; 2025 <span class="font-semibold text-amber-300">Sistem Penjualan Obat - Farma-Go</span>. All rights reserved.</p>
                            <p class="text-xs text-gray-400 mt-1">Solusi Terintegrasi untuk Manajemen Apotek Modern</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300 text-sm">
                                <span class="hidden sm:inline">Kebijakan Privasi</span>
                                <span class="sm:hidden">Privasi</span>
                            </a>
                  
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-700 text-center">
                        <p class="text-xs text-gray-400">Version 2.1.0 • Terakhir diperbarui: {{ now()->format('d M Y') }}</p>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            // Mobile Menu Toggle
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            
            if (mobileMenuToggle && mobileMenu) {
                mobileMenuToggle.addEventListener('click', () => {
                    mobileMenu.classList.toggle('active');
                    
                    // Change icon
                    const icon = mobileMenuToggle.querySelector('i');
                    if (mobileMenu.classList.contains('active')) {
                        icon.className = 'fas fa-times';
                    } else {
                        icon.className = 'fas fa-bars';
                    }
                });
                
                // Close mobile menu when clicking outside
                document.addEventListener('click', (event) => {
                    if (mobileMenu && mobileMenuToggle && 
                        !mobileMenu.contains(event.target) && 
                        !mobileMenuToggle.contains(event.target)) {
                        mobileMenu.classList.remove('active');
                        const icon = mobileMenuToggle.querySelector('i');
                        icon.className = 'fas fa-bars';
                    }
                });
                
                // Close mobile menu when clicking a link
                const mobileLinks = document.querySelectorAll('.mobile-nav-link');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.remove('active');
                        const icon = mobileMenuToggle.querySelector('i');
                        icon.className = 'fas fa-bars';
                    });
                });
            }
            
            // Theme detection
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.body.classList.add('dark');
            }
            
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                if (e.matches) {
                    document.body.classList.add('dark');
                } else {
                    document.body.classList.remove('dark');
                }
            });
            
            // Add active class to current page in navigation
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.custom-nav-link, .mobile-nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        </script>
    </body>
</html>