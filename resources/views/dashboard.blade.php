<x-app-layout>
    @section('title', 'Dashboard - Sistem Apotek POS')

    <!-- Set Header untuk Layout -->
    @php
        $header = 'Dashboard';
        $subtitle = 'Selamat datang di Sistem Apotek POS PharmaCare';
    @endphp

    @push('styles')
    <style>
        /* Animasi khusus untuk dashboard */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.15);
        }
        
        /* Responsif untuk chart */
        .chart-container {
            position: relative;
            height: 280px;
        }
        
        /* Badge dengan kontras tinggi */
        .role-badge {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            font-weight: 500;
            padding: 0.375rem 0.875rem;
        }
        
        /* Style untuk stok alert */
        .stock-alert-container {
            max-height: 200px;
            overflow-y: auto;
            padding-right: 0.5rem;
        }
        
        .stock-alert-container::-webkit-scrollbar {
            width: 4px;
        }
        
        .stock-alert-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        
        .stock-alert-container::-webkit-scrollbar-thumb {
            background: rgba(37, 99, 235, 0.3);
            border-radius: 4px;
        }
        
        .stock-alert-container::-webkit-scrollbar-thumb:hover {
            background: rgba(37, 99, 235, 0.5);
        }
        
        /* Animasi untuk summary cards */
        .summary-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .summary-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }
        
        .summary-card:hover::after {
            transform: translateX(0);
        }
        
        /* Styling untuk action cards */
        .action-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .action-card:hover .action-icon {
            transform: scale(1.1);
        }
        
        .action-icon {
            transition: transform 0.3s ease;
        }
        
        /* Recent activity styling */
        .activity-item {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .activity-item:hover {
            border-left-color: #2563eb;
            transform: translateX(3px);
        }
        
        @media (max-width: 768px) {
            .chart-container {
                height: 240px;
            }
            
            .summary-number {
                font-size: 1.75rem !important;
            }
            
            .welcome-text {
                font-size: 1.5rem !important;
            }
            
            .stock-alert-container {
                max-height: 160px;
            }
        }
        
        @media (max-width: 480px) {
            .chart-container {
                height: 200px;
            }
            
            .summary-number {
                font-size: 1.5rem !important;
            }
            
            .welcome-text {
                font-size: 1.25rem !important;
            }
        }
        
        /* Fade in animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
    @endpush

    <div class="space-y-6">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-6 text-white animate-fade-in-up">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <!-- Konten Teks -->
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold">
                            Selamat datang, <span class="text-blue-100">{{ auth()->user()->name }}!</span>
                        </h2>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <p class="text-blue-100">
                            Anda login sebagai
                        </p>
                        <span class="role-badge px-3 py-1 rounded-full font-medium text-sm">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>
                    
                    <p class="text-blue-100 mb-4">
                        Selamat bekerja dalam mengelola sistem apotek hari ini.
                    </p>
                    
                    <div class="flex items-center gap-2 text-blue-100">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm">
                            @php
                                // Set zona waktu ke WIB (Asia/Jakarta)
                                date_default_timezone_set('Asia/Jakarta');
                                
                                // Buat objek Carbon dengan zona waktu WIB
                                $nowWIB = \Carbon\Carbon::now('Asia/Jakarta');
                                
                                // Format tanggal dalam bahasa Indonesia
                                $hari = $nowWIB->translatedFormat('l'); // Nama hari
                                $tanggal = $nowWIB->translatedFormat('d F Y'); // Tanggal
                                $waktu = $nowWIB->format('H:i'); // Waktu
                            @endphp
                            {{ $hari }}, {{ $tanggal }}
                        </span>
                        <span class="mx-2">•</span>
                        <span class="text-sm">{{ $waktu }} WIB</span>
                    </div>
                </div>
            </div>
            
            <!-- Progress Bar untuk hari ini -->
            <div class="mt-6 pt-4 border-t border-white/20">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-blue-100">Progress Hari Ini</span>
                    <span class="text-sm font-medium text-blue-100">{{ $waktu }} WIB</span>
                </div>
                <div class="w-full bg-white/20 rounded-full h-1.5">
                    @php
                        // Hitung progress hari ini berdasarkan waktu WIB
                        $jam = $nowWIB->hour;
                        $menit = $nowWIB->minute;
                        $progress = (($jam * 60 + $menit) / 1440) * 100;
                    @endphp
                    <div class="bg-white h-1.5 rounded-full transition-all duration-500 ease-out" 
                         style="width: {{ $progress }}%"></div>
                </div>
            </div>
        </div>

        <!-- Alert Stok Minimum -->
        <div id="stock-alerts-container" class="mb-6">
            <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/20 border border-yellow-200 dark:border-yellow-700 rounded-xl p-4 hidden" id="stock-alert">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.928-.833-2.66 0L4.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <h4 class="font-semibold text-yellow-800 dark:text-yellow-200">Obat dengan Stok Rendah</h4>
                    </div>
                    <span class="bg-yellow-100 dark:bg-yellow-700 text-yellow-800 dark:text-yellow-100 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                        <span id="alert-count">0</span> item
                    </span>
                </div>
                <div id="stock-items" class="space-y-2 stock-alert-container"></div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Pembelian Bulan Ini -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700 summary-card card-hover">
                <div class="flex items-center">
                    <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg mr-4">
                        <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-gray-600 dark:text-gray-300 text-sm font-medium mb-1">Pembelian Bulan Ini</div>
                        <div class="text-2xl font-bold text-blue-700 dark:text-blue-400 summary-number" id="monthly-purchases">Rp 0</div>
                    </div>
                </div>
            </div>

            <!-- Penjualan Bulan Ini -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700 summary-card card-hover">
                <div class="flex items-center">
                    <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg mr-4">
                        <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-gray-600 dark:text-gray-300 text-sm font-medium mb-1">Penjualan Bulan Ini</div>
                        <div class="text-2xl font-bold text-blue-700 dark:text-blue-400 summary-number" id="monthly-sales">Rp 0</div>
                    </div>
                </div>
            </div>

            <!-- Total Obat -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700 summary-card card-hover">
                <div class="flex items-center">
                    <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg mr-4">
                        <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-gray-600 dark:text-gray-300 text-sm font-medium mb-1">Total Obat</div>
                        <div class="text-2xl font-bold text-blue-700 dark:text-blue-400 summary-number" id="total-medicines">0</div>
                    </div>
                </div>
            </div>

            <!-- Stok Rendah -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700 summary-card card-hover">
                <div class="flex items-center">
                    <div class="bg-yellow-50 dark:bg-yellow-900/30 p-3 rounded-lg mr-4">
                        <svg class="w-7 h-7 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.928-.833-2.66 0L4.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-gray-600 dark:text-gray-300 text-sm font-medium mb-1">Stok Rendah</div>
                        <div class="text-2xl font-bold text-yellow-700 dark:text-yellow-400 summary-number" id="low-stock-count">0</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Grafik Transaksi Bulanan -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Grafik Transaksi Bulanan</h3>
                </div>
                <div class="chart-container">
                    <canvas id="transactionChart"></canvas>
                </div>
            </div>

            <!-- Distribusi Stok Obat -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Distribusi Stok Obat</h3>
                </div>
                <div class="chart-container">
                    <canvas id="stockChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Action Cards -->
        <div>
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-5">Akses Cepat</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- Manajemen Obat -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700 action-card card-hover">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg mr-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400 action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">Manajemen Obat</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Kelola data obat, stok, harga, dan kategori</p>
                        </div>
                    </div>
                    <a href="{{ route('medicines.index') }}" 
                       class="inline-flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-300">
                        Kelola Obat
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

                <!-- Pembelian Obat -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700 action-card card-hover">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg mr-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400 action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">Pembelian Obat</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Kelola pembelian obat dari supplier</p>
                        </div>
                    </div>
                    <a href="{{ route('purchases.index') }}" 
                       class="inline-flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-300">
                        Lihat Pembelian
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

                <!-- Penjualan/Laporan Card -->
                @if(auth()->user()->isStaff())
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700 action-card card-hover">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg mr-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400 action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">Penjualan Obat</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Catat penjualan obat ke pelanggan</p>
                        </div>
                    </div>
                    <a href="{{ route('sales.index') }}" 
                       class="inline-flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-300">
                        Lihat Penjualan
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
                @else
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700 action-card card-hover">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg mr-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400 action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">Laporan</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Lihat laporan pembelian dan penjualan</p>
                        </div>
                    </div>
                    <a href="{{ route('reports.stock') }}" 
                       class="inline-flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-300">
                        Lihat Laporan
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center mb-4">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Aktivitas Terbaru</h3>
            </div>
            <div class="space-y-3">
                @php
                    // Contoh aktivitas dengan waktu WIB
                    $aktivitas = [
                        [
                            'jenis' => 'pembelian',
                            'deskripsi' => 'Pembelian obat baru dari Supplier ABC',
                            'waktu' => $nowWIB->copy()->subMinutes(10),
                            'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
                        ],
                        [
                            'jenis' => 'penjualan',
                            'deskripsi' => 'Transaksi penjualan berhasil #TX00123',
                            'waktu' => $nowWIB->copy()->subHours(1),
                            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                        ]
                    ];
                @endphp
                
                @foreach($aktivitas as $aktivitasItem)
                <div class="activity-item flex items-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <div class="bg-blue-100 dark:bg-blue-800 p-2 rounded-full mr-4">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $aktivitasItem['icon'] }}"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 dark:text-gray-200 font-medium">{{ $aktivitasItem['deskripsi'] }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                            {{ $aktivitasItem['waktu']->diffForHumans() }}
                            ({{ $aktivitasItem['waktu']->format('H:i') }} WIB)
                        </p>
                    </div>
                    <span class="bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-300 text-xs font-medium px-2.5 py-1 rounded-full">
                        {{ ucfirst($aktivitasItem['jenis']) }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pastikan dokumen sudah dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mendapatkan waktu WIB sekarang
            function getWIBTime() {
                const now = new Date();
                // UTC+7 untuk WIB
                const utcTime = now.getTime() + (now.getTimezoneOffset() * 60000);
                const wibTime = new Date(utcTime + (7 * 3600000));
                return wibTime;
            }

            // Fungsi untuk format waktu WIB
            function formatWIBTime(date) {
                const hours = date.getHours().toString().padStart(2, '0');
                const minutes = date.getMinutes().toString().padStart(2, '0');
                return `${hours}:${minutes} WIB`;
            }

            // Fungsi untuk format tanggal Indonesia
            function formatIDDate(date) {
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                
                const dayName = days[date.getDay()];
                const day = date.getDate();
                const month = months[date.getMonth()];
                const year = date.getFullYear();
                
                return `${dayName}, ${day} ${month} ${year}`;
            }

            // Update waktu real-time
            function updateRealTime() {
                const nowWIB = getWIBTime();
                const timeElement = document.querySelector('.time-wib');
                const dateElement = document.querySelector('.date-wib');
                
                if (timeElement) {
                    timeElement.textContent = formatWIBTime(nowWIB);
                }
                
                if (dateElement) {
                    dateElement.textContent = formatIDDate(nowWIB);
                }
                
                // Update progress bar
                const hours = nowWIB.getHours();
                const minutes = nowWIB.getMinutes();
                const progress = ((hours * 60 + minutes) / 1440) * 100;
                
                const progressBar = document.querySelector('.progress-bar-fill');
                if (progressBar) {
                    progressBar.style.width = `${progress}%`;
                }
            }

            // Jalankan update waktu setiap menit
            updateRealTime();
            setInterval(updateRealTime, 60000);

            // Load monthly data for transaction chart
            fetch('{{ route("reports.monthly-data") }}')
                .then(res => res.json())
                .then(data => {
                    initializeTransactionChart(data);
                    updateSummaryTotals(data);
                })
                .catch(() => {
                    // Fallback jika API tidak tersedia
                    initializeTransactionChart();
                });

            // Load stock alerts
            loadStockAlerts();
            
            // Tambahkan event listener untuk resize window
            window.addEventListener('resize', function() {
                // Re-initialize charts on resize untuk responsif
                if (window.transactionChart) {
                    window.transactionChart.destroy();
                }
                if (window.stockChart) {
                    window.stockChart.destroy();
                }
                
                // Tunggu sebentar sebelum re-initialize
                setTimeout(() => {
                    initializeTransactionChart();
                    initializeStockChart();
                }, 200);
            });
        });

        function initializeTransactionChart(data = null) {
            const ctx = document.getElementById('transactionChart');
            if (!ctx) return;

            const defaultData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                purchases: [15000000, 18000000, 22000000, 19000000, 24000000, 21000000],
                sales: [12000000, 15000000, 18000000, 16000000, 20000000, 17000000]
            };

            const chartData = data || defaultData;
            
            window.transactionChart = new Chart(ctx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: chartData.labels || chartData.months || defaultData.labels,
                    datasets: [
                        {
                            label: 'Pembelian',
                            data: chartData.purchases || defaultData.purchases,
                            borderColor: '#2563eb',
                            backgroundColor: 'rgba(37, 99, 235, 0.1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Penjualan',
                            data: chartData.sales || defaultData.sales,
                            borderColor: '#1d4ed8',
                            backgroundColor: 'rgba(29, 78, 216, 0.1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            position: 'top',
                            labels: {
                                font: {
                                    size: window.innerWidth < 768 ? 11 : 13,
                                    family: "'Instrument Sans', sans-serif",
                                    weight: 600
                                }
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(255, 255, 255, 0.95)',
                            titleColor: '#1f2937',
                            bodyColor: '#4b5563',
                            borderColor: '#e5e7eb',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                            minimumFractionDigits: 0
                                        }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            ticks: { 
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000).toFixed(1) + ' jt';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000).toFixed(0) + ' rb';
                                    }
                                    return 'Rp ' + value;
                                },
                                font: {
                                    size: window.innerWidth < 768 ? 10 : 12,
                                    family: "'Instrument Sans', sans-serif"
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: window.innerWidth < 768 ? 10 : 12,
                                    family: "'Instrument Sans', sans-serif"
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        }
                    }
                }
            });
        }

        function updateSummaryTotals(data) {
            const purchaseTotal = (data.purchases || []).reduce((a, b) => a + b, 0);
            const salesTotal = (data.sales || []).reduce((a, b) => a + b, 0);
            
            const purchasesEl = document.getElementById('monthly-purchases');
            const salesEl = document.getElementById('monthly-sales');
            
            if (purchasesEl) {
                purchasesEl.textContent = formatCurrency(purchaseTotal);
            }
            if (salesEl) {
                salesEl.textContent = formatCurrency(salesTotal);
            }
            
            function formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(amount);
            }
        }

        function loadStockAlerts() {
            fetch('{{ route("reports.stock-alerts") }}')
                .then(res => res.json())
                .then(items => {
                    displayStockAlerts(items);
                })
                .catch(() => {
                    // Contoh data untuk development
                    const exampleItems = [
                        { name: 'Paracetamol 500mg', stock: 5, min_stock: 10 },
                        { name: 'Amoxicillin 500mg', stock: 8, min_stock: 15 },
                        { name: 'Vitamin C 500mg', stock: 3, min_stock: 10 }
                    ];
                    setTimeout(() => displayStockAlerts(exampleItems), 500);
                });
        }

        function displayStockAlerts(items) {
            const container = document.getElementById('stock-items');
            const alertDiv = document.getElementById('stock-alert');
            const lowStockCount = document.getElementById('low-stock-count');
            const alertCount = document.getElementById('alert-count');
            const totalMedicines = document.getElementById('total-medicines');
            
            if (!items || items.length === 0) {
                if (alertDiv) alertDiv.classList.add('hidden');
                return;
            }
            
            if (alertDiv) alertDiv.classList.remove('hidden');
            
            if (container) {
                const html = items.map(item => `
                    <div class="flex items-center p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg">
                        <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <div class="font-medium text-yellow-800 dark:text-yellow-200 truncate text-sm">${item.name}</div>
                            <div class="text-xs text-yellow-600 dark:text-yellow-400 mt-0.5">
                                Stok: <span class="font-semibold">${item.stock}</span> | Min: <span class="font-semibold">${item.min_stock}</span>
                            </div>
                        </div>
                    </div>
                `).join('');
                container.innerHTML = html;
            }
            
            if (lowStockCount) lowStockCount.textContent = items.length;
            if (alertCount) alertCount.textContent = items.length;
            if (totalMedicines) totalMedicines.textContent = items.length * 21;
        }

        // Initialize stock chart
        function initializeStockChart() {
            const ctx = document.getElementById('stockChart')?.getContext('2d');
            if (ctx) {
                window.stockChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Stok Normal', 'Stok Rendah', 'Hampir Habis'],
                        datasets: [{
                            data: [35, 7, 3],
                            backgroundColor: ['#2563eb', '#f59e0b', '#ef4444'],
                            borderWidth: 0,
                            hoverOffset: 15
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { 
                            legend: { 
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: window.innerWidth < 768 ? 11 : 13,
                                        family: "'Instrument Sans', sans-serif",
                                        weight: 500
                                    },
                                    padding: 15,
                                    usePointStyle: true,
                                    pointStyle: 'circle'
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(255, 255, 255, 0.95)',
                                titleColor: '#1f2937',
                                bodyColor: '#4b5563',
                                borderColor: '#e5e7eb',
                                borderWidth: 1,
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += context.parsed + '%';
                                        return label;
                                    }
                                }
                            }
                        },
                        cutout: '70%'
                    }
                });
            }
        }

        // Tunggu sebentar sebelum initialize stock chart
        setTimeout(() => {
            initializeStockChart();
        }, 1000);
    </script>
</x-app-layout>