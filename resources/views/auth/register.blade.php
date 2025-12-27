<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Daftar Akun - PharmaCare</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* Reset & Base Styles */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            :root {
                --primary: #10B981;
                --primary-dark: #059669;
                --primary-light: #34D399;
                --secondary: #1A202C;
                --text: #2D3748;
                --text-light: #718096;
                --bg: #FFFFFF;
                --bg-secondary: #F7FAFC;
                --bg-gradient: linear-gradient(135deg, #f0fdf4 0%, #f7fee7 100%);
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
                    --bg-gradient: linear-gradient(135deg, #064E3B 0%, #052E16 100%);
                }
            }

            body {
                font-family: var(--font-sans);
                background: var(--bg-gradient);
                color: var(--text);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
                line-height: 1.6;
            }

            /* Animations */
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(2deg); }
                50% { transform: translateY(-20px) rotate(2deg); }
            }

            @keyframes shimmer {
                0% { background-position: -1000px 0; }
                100% { background-position: 1000px 0; }
            }

            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
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

            /* Utility Classes */
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            .animate-pulse {
                animation: pulse 2s ease-in-out infinite;
            }

            .animate-slide-in {
                animation: slideIn 0.6s ease-out forwards;
            }

            .text-gradient {
                background: linear-gradient(135deg, var(--primary), #34D399);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* Main Container */
            .register-container {
                width: 100%;
                max-width: 440px;
                margin: 0 auto;
                position: relative;
            }

            /* Decorative Elements */
            .bg-pattern {
                position: fixed;
                inset: 0;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2310B981' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                opacity: 0.3;
                z-index: -1;
            }

            .floating-element {
                position: absolute;
                z-index: -1;
                opacity: 0.2;
            }

            .floating-element:nth-child(1) {
                top: 10%;
                left: 10%;
                width: 150px;
                height: 150px;
                background: linear-gradient(135deg, var(--primary), #34D399);
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
                animation: float 8s ease-in-out infinite;
            }

            .floating-element:nth-child(2) {
                bottom: 10%;
                right: 10%;
                width: 100px;
                height: 100px;
                background: linear-gradient(135deg, #34D399, var(--primary));
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
                animation: float 10s ease-in-out infinite reverse;
            }

            /* Card Styles */
            .register-card {
                background: rgba(255, 255, 255, 0.92);
                backdrop-filter: blur(10px);
                border-radius: var(--radius);
                box-shadow: var(--shadow-lg);
                border: 1px solid rgba(255, 255, 255, 0.2);
                overflow: hidden;
                position: relative;
                transform: translateY(0);
                transition: var(--transition);
            }

            .register-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 25px 50px -12px rgba(16, 185, 129, 0.15);
            }

            .dark .register-card {
                background: rgba(15, 23, 42, 0.9);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            /* Header Section */
            .card-header {
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                padding: 2.5rem;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .card-header::before {
                content: '';
                position: absolute;
                inset: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            .logo-container {
                position: relative;
                z-index: 2;
            }

            .logo-icon {
                width: 64px;
                height: 64px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                border: 2px solid rgba(255, 255, 255, 0.3);
                backdrop-filter: blur(10px);
                transform: rotate(3deg);
            }

            .logo-icon svg {
                width: 32px;
                height: 32px;
                color: white;
            }

            .card-title {
                color: white;
                font-size: 1.875rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
                position: relative;
                z-index: 2;
            }

            .card-subtitle {
                color: rgba(255, 255, 255, 0.9);
                font-size: 1rem;
                position: relative;
                z-index: 2;
            }

            /* Form Styles */
            .form-container {
                padding: 2.5rem;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: flex;
                align-items: center;
                font-weight: 600;
                color: var(--text);
                margin-bottom: 0.5rem;
                font-size: 0.9375rem;
            }

            .form-label svg {
                width: 18px;
                height: 18px;
                margin-right: 0.5rem;
                color: var(--primary);
            }

            .form-input {
                width: 100%;
                padding: 1rem 1.25rem;
                background: var(--bg-secondary);
                border: 2px solid var(--border);
                border-radius: 10px;
                font-family: inherit;
                font-size: 1rem;
                color: var(--text);
                transition: var(--transition);
                position: relative;
            }

            .form-input:focus {
                outline: none;
                border-color: var(--primary);
                background: white;
                box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
                transform: translateY(-2px);
            }

            .dark .form-input:focus {
                background: var(--bg);
            }

            .input-wrapper {
                position: relative;
            }

            .input-icon {
                position: absolute;
                right: 1.25rem;
                top: 50%;
                transform: translateY(-50%);
                color: var(--text-light);
                pointer-events: none;
            }

            .input-icon-right {
                right: 1.25rem;
            }

            .password-toggle {
                position: absolute;
                right: 1.25rem;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: var(--text-light);
                cursor: pointer;
                padding: 0.25rem;
                transition: var(--transition);
            }

            .password-toggle:hover {
                color: var(--primary);
            }

            /* Error Messages */
            .error-message {
                color: #EF4444;
                font-size: 0.875rem;
                margin-top: 0.5rem;
                display: flex;
                align-items: center;
            }

            .error-message svg {
                width: 16px;
                height: 16px;
                margin-right: 0.375rem;
            }

            /* Terms Checkbox */
            .terms-group {
                display: flex;
                align-items: flex-start;
                gap: 0.75rem;
                margin: 1.5rem 0;
                padding: 1rem;
                background: var(--bg-secondary);
                border-radius: 10px;
                border: 1px solid var(--border);
            }

            .terms-checkbox {
                width: 20px;
                height: 20px;
                margin-top: 0.125rem;
                accent-color: var(--primary);
                cursor: pointer;
                flex-shrink: 0;
            }

            .terms-label {
                color: var(--text-light);
                font-size: 0.875rem;
                line-height: 1.5;
            }

            .terms-label a {
                color: var(--primary);
                text-decoration: none;
                font-weight: 600;
                transition: var(--transition);
            }

            .terms-label a:hover {
                text-decoration: underline;
            }

            /* Submit Button */
            .submit-button {
                width: 100%;
                padding: 1rem;
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                color: white;
                border: none;
                border-radius: 10px;
                font-family: inherit;
                font-size: 1.125rem;
                font-weight: 600;
                cursor: pointer;
                transition: var(--transition);
                position: relative;
                overflow: hidden;
            }

            .submit-button:hover {
                background: linear-gradient(135deg, var(--primary-dark), #047857);
                transform: translateY(-2px);
                box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
            }

            .submit-button:active {
                transform: translateY(0);
            }

            .submit-button::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.5s;
            }

            .submit-button:hover::before {
                left: 100%;
            }

            .button-content {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.75rem;
            }

            /* Login Link */
            .login-link {
                text-align: center;
                margin-top: 1.5rem;
                padding-top: 1.5rem;
                border-top: 1px solid var(--border);
                color: var(--text-light);
                font-size: 0.9375rem;
            }

            .login-link a {
                color: var(--primary);
                text-decoration: none;
                font-weight: 600;
                margin-left: 0.25rem;
                transition: var(--transition);
            }

            .login-link a:hover {
                text-decoration: underline;
            }

            /* Footer */
            .card-footer {
                padding: 1.5rem 2.5rem;
                background: var(--bg-secondary);
                border-top: 1px solid var(--border);
                text-align: center;
                font-size: 0.8125rem;
                color: var(--text-light);
            }

            /* Responsive Design */
            @media (max-width: 480px) {
                .register-container {
                    max-width: 100%;
                }

                .card-header {
                    padding: 2rem 1.5rem;
                }

                .form-container {
                    padding: 2rem 1.5rem;
                }

                .card-footer {
                    padding: 1.25rem 1.5rem;
                }

                .card-title {
                    font-size: 1.5rem;
                }

                .form-input {
                    padding: 0.875rem 1rem;
                }
            }

            /* Loading Animation */
            .loading {
                display: inline-block;
                width: 20px;
                height: 20px;
                border: 3px solid rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                border-top-color: white;
                animation: spin 1s ease-in-out infinite;
            }

            @keyframes spin {
                to { transform: rotate(360deg); }
            }
        </style>
    </head>
    <body class="dark:bg-gray-900">
        <!-- Background Pattern -->
        <div class="bg-pattern"></div>
        
        <!-- Floating Elements -->
        <div class="floating-element"></div>
        <div class="floating-element"></div>

        <!-- Main Container -->
        <div class="register-container animate-slide-in">
            <!-- Register Card -->
            <div class="register-card">
                <!-- Card Header -->
                <div class="card-header">
                    <div class="logo-container">
                        <div class="logo-icon animate-float">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M21 12c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8z" />
                            </svg>
                        </div>
                        <h1 class="card-title">PharmaCare</h1>
                        <p class="card-subtitle">Daftar Akun Baru</p>
                    </div>
                </div>

                <!-- Form -->
                <div class="form-container">
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf

                        <!-- Name Field -->
                        <div class="form-group">
                            <label class="form-label" for="name">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Nama Lengkap
                            </label>
                            <div class="input-wrapper">
                                <input id="name" 
                                       class="form-input" 
                                       type="text" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       autofocus 
                                       autocomplete="name"
                                       placeholder="Masukkan nama lengkap Anda">
                                <span class="input-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                            </div>
                            @error('name')
                                <div class="error-message">
                                    <svg fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-group">
                            <label class="form-label" for="email">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Email
                            </label>
                            <div class="input-wrapper">
                                <input id="email" 
                                       class="form-input" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autocomplete="username"
                                       placeholder="contoh@email.com">
                                <span class="input-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                            </div>
                            @error('email')
                                <div class="error-message">
                                    <svg fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label class="form-label" for="password">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Password
                            </label>
                            <div class="input-wrapper">
                                <input id="password" 
                                       class="form-input password-input" 
                                       type="password"
                                       name="password"
                                       required 
                                       autocomplete="new-password"
                                       placeholder="Minimal 8 karakter">
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <div class="error-message">
                                    <svg fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group">
                            <label class="form-label" for="password_confirmation">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Konfirmasi Password
                            </label>
                            <div class="input-wrapper">
                                <input id="password_confirmation" 
                                       class="form-input password-input" 
                                       type="password"
                                       name="password_confirmation" 
                                       required 
                                       autocomplete="new-password"
                                       placeholder="Ketik ulang password Anda">
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="error-message">
                                    <svg fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Terms Checkbox -->
                        <div class="terms-group">
                            <input id="terms" 
                                   name="terms" 
                                   type="checkbox" 
                                   class="terms-checkbox"
                                   required>
                            <label for="terms" class="terms-label">
                                Dengan mendaftar, Anda menyetujui 
                                <a href="#">Syarat & Ketentuan</a> 
                                dan 
                                <a href="#">Kebijakan Privasi</a> 
                                kami.
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="submit-button" id="submitButton">
                            <span class="button-content">
                                <span>Daftar Sekarang</span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </button>

                        <!-- Login Link -->
                        <div class="login-link">
                            Sudah punya akun?
                            <a href="{{ route('login') }}">Masuk di sini</a>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="card-footer">
                    © 2025 PharmaCare • Apotek Online Terpercaya
                </div>
            </div>
        </div>

        <script>
            // Password toggle functionality
            function togglePassword(fieldId) {
                const input = document.getElementById(fieldId);
                const toggleBtn = input.nextElementSibling;
                
                if (input.type === 'password') {
                    input.type = 'text';
                    toggleBtn.innerHTML = `
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    `;
                } else {
                    input.type = 'password';
                    toggleBtn.innerHTML = `
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    `;
                }
            }

            // Form submission animation
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                const submitButton = document.getElementById('submitButton');
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <span class="button-content">
                        <span class="loading"></span>
                        <span>Memproses...</span>
                    </span>
                `;
            });

            // Add focus effects to inputs
            document.querySelectorAll('.form-input').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });

            // Add validation feedback
            document.querySelectorAll('.form-input').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        this.classList.remove('error');
                        this.classList.add('valid');
                    } else {
                        this.classList.remove('valid');
                    }
                });
            });

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

            // Add ripple effect to button
            document.querySelector('.submit-button').addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.4);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    width: ${size}px;
                    height: ${size}px;
                    top: ${y}px;
                    left: ${x}px;
                `;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });

            // Add CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
                
                .form-input.valid {
                    border-color: #10B981;
                    background-color: rgba(16, 185, 129, 0.05);
                }
                
                .form-input.error {
                    border-color: #EF4444;
                    background-color: rgba(239, 68, 68, 0.05);
                }
            `;
            document.head.appendChild(style);
        </script>
    </body>
</html>