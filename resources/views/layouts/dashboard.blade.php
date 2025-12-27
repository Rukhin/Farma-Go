@extends('layouts.app')

@section('title', 'Dashboard - Sistem Apotek POS')

@section('header')
    Dashboard Utama
@endsection

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-emerald-500 to-green-600 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold mb-2">Selamat datang, {{ auth()->user()->name }}!</h2>
                <p class="text-emerald-100 text-lg mb-4">Anda login sebagai <span class="bg-white/20 px-3 py-1 rounded-full font-semibold">{{ ucfirst(auth()->user()->role) }}</span></p>
                <p class="text-emerald-100 opacity-90">Selamat bekerja dalam mengelola sistem apotek hari ini.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Today's Summary -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
            <div class="flex items-center mb-4">
                <div class="bg-amber-50 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Ringkasan Hari Ini</h3>
            </div>
            <p class="text-gray-600 mb-4">Pantau aktivitas transaksi dan stok obat harian.</p>
            <div class="text-sm text-gray-500 space-y-2">
                <div class="flex justify-between items-center">
                    <span>Transaksi Berhasil</span>
                    <span class="font-semibold text-green-600">12</span>
                </div>
                <div class="flex justify-between items-center">
                    <span>Obat Akan Habis</span>
                    <span class="font-semibold text-amber-600">5</span>
                </div>
                <div class="flex justify-between items-center">
                    <span>Pendapatan Hari Ini</span>
                    <span class="font-semibold text-emerald-600">Rp 2.450.000</span>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
            <div class="flex items-center mb-4">
                <div class="bg-green-50 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Status Sistem</h3>
            </div>
            <p class="text-gray-600 mb-4">Semua sistem berjalan dengan baik.</p>
            <div class="space-y-3">
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                    <span class="text-gray-700">Database Terhubung</span>
                </div>
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                    <span class="text-gray-700">Server Aktif</span>
                </div>
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                    <span class="text-gray-700">Backup Terakhir: {{ now()->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div>
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Akses Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Pembelian Card -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-md p-6 border border-blue-100 transform transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                <div class="flex items-start mb-4">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Pembelian Obat</h3>
                        <p class="text-gray-600 text-sm mt-1">Kelola pembelian obat dari supplier</p>
                    </div>
                </div>
                <a href="{{ route('transactions.index', ['type' => 'purchase']) }}" 
                   class="inline-flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-300 mt-4">
                    Lihat Pembelian
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Penjualan Card (Visible for admin and staff) -->
            @if(auth()->user()->isAdmin() || auth()->user()->isStaff())
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl shadow-md p-6 border border-green-100 transform transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                <div class="flex items-start mb-4">
                    <div class="bg-green-100 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Penjualan Obat</h3>
                        <p class="text-gray-600 text-sm mt-1">Catat penjualan obat ke pelanggan</p>
                    </div>
                </div>
                <a href="{{ route('transactions.index', ['type' => 'sale']) }}" 
                   class="inline-flex items-center justify-center w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-300 mt-4">
                    Lihat Penjualan
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
            @endif

            <!-- Additional Quick Action Card -->
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl shadow-md p-6 border border-emerald-100 transform transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                <div class="flex items-start mb-4">
                    <div class="bg-emerald-100 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Laporan Bulanan</h3>
                        <p class="text-gray-600 text-sm mt-1">Analisis performa penjualan bulanan</p>
                    </div>
                </div>
                <a href="#" 
                   class="inline-flex items-center justify-center w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-300 mt-4">
                    Lihat Laporan
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>
        <div class="space-y-4">
            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                <div class="bg-blue-100 p-2 rounded-full mr-4">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800 font-medium">Pembelian obat baru dari Supplier ABC</p>
                    <p class="text-gray-500 text-sm">10 menit yang lalu</p>
                </div>
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Pembelian</span>
            </div>
            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                <div class="bg-green-100 p-2 rounded-full mr-4">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800 font-medium">Transaksi penjualan berhasil #TX00123</p>
                    <p class="text-gray-500 text-sm">1 jam yang lalu</p>
                </div>
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Penjualan</span>
            </div>
        </div>
    </div>
</div>
@endsection