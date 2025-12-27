<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Obat') }}
            </h2>
            <a href="{{ route('medicines.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('medicines.update', $medicine) }}" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Code -->
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                            Kode Obat <span class="text-red-600">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="code" 
                            name="code"
                            placeholder="Contoh: MED001"
                            value="{{ old('code', $medicine->code) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('code') border-red-500 @enderror"
                        >
                        @error('code')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Obat <span class="text-red-600">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name"
                            placeholder="Contoh: Paracetamol"
                            value="{{ old('name', $medicine->name) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror"
                        >
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="medicine_category_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Kategori <span class="text-red-600">*</span>
                        </label>
                        <select 
                            id="medicine_category_id" 
                            name="medicine_category_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('medicine_category_id') border-red-500 @enderror"
                        >
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('medicine_category_id', $medicine->medicine_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('medicine_category_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Unit -->
                    <div>
                        <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">
                            Unit/Satuan <span class="text-red-600">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="unit" 
                            name="unit"
                            placeholder="Contoh: Tablet, Botol, Kotak, dll"
                            value="{{ old('unit', $medicine->unit) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('unit') border-red-500 @enderror"
                        >
                        @error('unit')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prices Row -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Purchase Price -->
                        <div>
                            <label for="price_purchase" class="block text-sm font-medium text-gray-700 mb-1">
                                Harga Beli (Rp) <span class="text-red-600">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="price_purchase" 
                                name="price_purchase"
                                min="0"
                                step="100"
                                value="{{ old('price_purchase', $medicine->price_purchase) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('price_purchase') border-red-500 @enderror"
                            >
                            @error('price_purchase')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sale Price -->
                        <div>
                            <label for="price_sale" class="block text-sm font-medium text-gray-700 mb-1">
                                Harga Jual (Rp) <span class="text-red-600">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="price_sale" 
                                name="price_sale"
                                min="0"
                                step="100"
                                value="{{ old('price_sale', $medicine->price_sale) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('price_sale') border-red-500 @enderror"
                            >
                            @error('price_sale')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Stock Row -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Current Stock -->
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
                                Stok Saat Ini <span class="text-red-600">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="stock" 
                                name="stock"
                                min="0"
                                value="{{ old('stock', $medicine->stock) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('stock') border-red-500 @enderror"
                            >
                            @error('stock')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Minimum Stock -->
                        <div>
                            <label for="min_stock" class="block text-sm font-medium text-gray-700 mb-1">
                                Stok Minimum <span class="text-red-600">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="min_stock" 
                                name="min_stock"
                                min="0"
                                value="{{ old('min_stock', $medicine->min_stock) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('min_stock') border-red-500 @enderror"
                            >
                            @error('min_stock')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Deskripsi
                        </label>
                        <textarea 
                            id="description" 
                            name="description"
                            rows="4"
                            placeholder="Masukkan deskripsi obat (opsional)"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('description') border-red-500 @enderror"
                        >{{ old('description', $medicine->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-4 pt-4">
                        <button 
                            type="submit" 
                            class="flex-1 px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-medium"
                        >
                            💾 Update Obat
                        </button>
                        <a 
                            href="{{ route('medicines.index') }}" 
                            class="flex-1 px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 text-center font-medium"
                        >
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
