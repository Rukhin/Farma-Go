<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Obat') }}
            </h2>
            <a href="{{ route('medicines.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header Info -->
                    <div class="mb-8 pb-6 border-b border-gray-200">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $medicine->name }}</h1>
                        <p class="text-gray-600">Kode: <span class="font-mono font-semibold">{{ $medicine->code }}</span></p>
                    </div>

                    <!-- Main Details -->
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Kategori</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $medicine->category->name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Unit/Satuan</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $medicine->unit }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Harga Beli</p>
                                <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($medicine->price_purchase, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Harga Jual</p>
                                <p class="text-lg font-semibold text-green-600">Rp {{ number_format($medicine->price_sale, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Margin Keuntungan</p>
                                @php
                                    $profit = $medicine->price_sale - $medicine->price_purchase;
                                    $margin = $medicine->price_purchase > 0 ? ($profit / $medicine->price_purchase * 100) : 0;
                                @endphp
                                <p class="text-lg font-semibold text-blue-600">{{ number_format($margin, 1) }}% (Rp {{ number_format($profit, 0, ',', '.') }})</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Stok Minimum</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $medicine->min_stock }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Status Card -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6 mb-8">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-center">
                                <p class="text-sm text-gray-600 mb-2">Stok Saat Ini</p>
                                <p class="text-4xl font-bold text-blue-600">{{ $medicine->stock }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-600 mb-2">Status</p>
                                <div>
                                    @if($medicine->stock == 0)
                                        <span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-semibold rounded-full">Kosong</span>
                                    @elseif($medicine->stock < $medicine->min_stock)
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">Rendah ⚠️</span>
                                    @else
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">Aman ✓</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-600 mb-2">Nilai Stok</p>
                                <p class="text-2xl font-bold text-indigo-600">Rp {{ number_format($medicine->stock * $medicine->price_purchase, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($medicine->description)
                    <div class="mb-8 pb-6 border-b border-gray-200">
                        <p class="text-sm text-gray-600 mb-2">Deskripsi</p>
                        <p class="text-gray-700">{{ $medicine->description }}</p>
                    </div>
                    @endif

                    <!-- Timestamps -->
                    <div class="grid grid-cols-2 gap-6 text-xs text-gray-500 mb-8">
                        <div>
                            <p>Dibuat pada:</p>
                            <p class="font-semibold">{{ $medicine->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            <p>Diperbarui pada:</p>
                            <p class="font-semibold">{{ $medicine->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <a 
                            href="{{ route('medicines.edit', $medicine) }}" 
                            class="flex-1 px-6 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 text-center font-medium"
                        >
                            ✏️ Edit
                        </a>
                        <form method="POST" action="{{ route('medicines.destroy', $medicine) }}" style="flex: 1;" 
                              onsubmit="return confirm('Yakin ingin menghapus obat ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700 font-medium">
                            Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
