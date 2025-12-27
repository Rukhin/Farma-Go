<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Obat') }}
            </h2>
            <a href="{{ route('medicines.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                ➕ Tambah Obat
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
            <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
            @endif

            <!-- Error Message -->
            @if (session('error'))
            <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
            @endif

            <!-- Filters & Search -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('medicines.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cari Obat</label>
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Nama atau Kode Obat..."
                                value="{{ request('search') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            >
                        </div>

                        <!-- Category Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Stock Status Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Stok</label>
                            <select name="stock_status" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Stok Rendah</option>
                                <option value="empty" {{ request('stock_status') == 'empty' ? 'selected' : '' }}>Stok Kosong</option>
                            </select>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-end gap-2">
                            <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                🔍 Filter
                            </button>
                            <a href="{{ route('medicines.index') }}" class="flex-1 px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 text-center">
                                Reset
                            </a>
                            <a href="{{ route('medicines.export') }}" class="flex-1 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                📥 Export CSV
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Medicines Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-gray-100 border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">Kode</th>
                                <th class="px-4 py-3 text-left font-semibold">Nama</th>
                                <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                                <th class="px-4 py-3 text-left font-semibold">Unit</th>
                                <th class="px-4 py-3 text-right font-semibold">Harga Beli</th>
                                <th class="px-4 py-3 text-right font-semibold">Harga Jual</th>
                                <th class="px-4 py-3 text-center font-semibold">Stok</th>
                                <th class="px-4 py-3 text-center font-semibold">Min Stok</th>
                                <th class="px-4 py-3 text-center font-semibold">Status</th>
                                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medicines as $medicine)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-3 font-mono text-sm">{{ $medicine->code }}</td>
                                <td class="px-4 py-3 font-medium">{{ $medicine->name }}</td>
                                <td class="px-4 py-3">{{ $medicine->category->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $medicine->unit }}</td>
                                <td class="px-4 py-3 text-right">Rp {{ number_format($medicine->price_purchase, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right">Rp {{ number_format($medicine->price_sale, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-center font-semibold">{{ $medicine->stock }}</td>
                                <td class="px-4 py-3 text-center">{{ $medicine->min_stock }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if($medicine->stock == 0)
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded">Kosong</span>
                                    @elseif($medicine->stock < $medicine->min_stock)
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded">Rendah</span>
                                    @else
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded">Aman</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    <a href="{{ route('medicines.show', $medicine) }}" class="text-blue-600 hover:text-blue-800" title="Lihat">👁️</a>
                                    <a href="{{ route('medicines.edit', $medicine) }}" class="text-yellow-600 hover:text-yellow-800" title="Edit">✏️</a>
                                    <form method="POST" action="{{ route('medicines.destroy', $medicine) }}" style="display:inline;" 
                                          onsubmit="return confirm('Yakin ingin menghapus obat ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">🗑️</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                                    Tidak ada data obat
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-4 py-4 border-t border-gray-200">
                    {{ $medicines->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
