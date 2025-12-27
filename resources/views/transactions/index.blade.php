<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Transaksi') }}
            </h2>
            <div class="flex space-x-2">
                @if(auth()->user()->isAdmin() || auth()->user()->isStaff())
                <a href="{{ route('transactions.createPurchase') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    ➕ Tambah Pembelian
                </a>
                @endif
                @if(auth()->user()->isStaff())
                <a href="{{ route('transactions.createSale') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    ➕ Tambah Penjualan
                </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Tabs -->
            <div class="mb-6">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <a href="{{ route('transactions.index', ['type' => 'all']) }}"
                           class="py-2 px-1 border-b-2 font-medium text-sm {{ $query === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Semua Transaksi
                        </a>
                        <a href="{{ route('transactions.index', ['type' => 'purchase']) }}"
                           class="py-2 px-1 border-b-2 font-medium text-sm {{ $query === 'purchase' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Pembelian
                        </a>
                        <a href="{{ route('transactions.index', ['type' => 'sale']) }}"
                           class="py-2 px-1 border-b-2 font-medium text-sm {{ $query === 'sale' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Penjualan
                        </a>
                    </nav>
                </div>
            </div>

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

            @if($query === 'all')
                <!-- Combined View -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Purchases -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-blue-50 border-b border-blue-200">
                            <h3 class="text-lg font-semibold text-blue-800">Pembelian Terbaru</h3>
                        </div>
                        <div class="p-6">
                            @if($purchases->count() > 0)
                                <div class="space-y-4">
                                    @foreach($purchases as $purchase)
                                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $purchase->supplier->name ?? 'Supplier' }}</p>
                                            <p class="text-sm text-gray-600">{{ $purchase->created_at->format('d M Y H:i') }}</p>
                                            <p class="text-sm text-gray-500">{{ $purchase->items->count() }} item(s)</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-blue-600">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</p>
                                            <a href="{{ route('purchases.show', $purchase) }}" class="text-xs text-blue-500 hover:text-blue-700">Lihat Detail</a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="{{ route('purchases.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Lihat Semua Pembelian →
                                    </a>
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-8">Belum ada data pembelian</p>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Sales -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-green-50 border-b border-green-200">
                            <h3 class="text-lg font-semibold text-green-800">Penjualan Terbaru</h3>
                        </div>
                        <div class="p-6">
                            @if($sales->count() > 0)
                                <div class="space-y-4">
                                    @foreach($sales as $sale)
                                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $sale->customer_name ?? 'Pelanggan' }}</p>
                                            <p class="text-sm text-gray-600">{{ $sale->created_at->format('d M Y H:i') }}</p>
                                            <p class="text-sm text-gray-500">{{ $sale->items->count() }} item(s)</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-green-600">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</p>
                                            <a href="{{ route('sales.show', $sale) }}" class="text-xs text-green-500 hover:text-green-700">Lihat Detail</a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="{{ route('sales.index') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                        Lihat Semua Penjualan →
                                    </a>
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-8">Belum ada data penjualan</p>
                            @endif
                        </div>
                    </div>
                </div>
            @elseif($query === 'purchase')
                <!-- Purchases Table -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Daftar Pembelian</h3>
                    </div>
                    <div class="p-6">
                        @if($purchases->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($purchases as $purchase)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $purchase->created_at->format('d M Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $purchase->supplier->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $purchase->items->count() }} item(s)
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('purchases.show', $purchase) }}" class="text-blue-600 hover:text-blue-900">Lihat</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $purchases->links() }}
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">Belum ada data pembelian</p>
                        @endif
                    </div>
                </div>
            @elseif($query === 'sale')
                <!-- Sales Table -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Daftar Penjualan</h3>
                    </div>
                    <div class="p-6">
                        @if($sales->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($sales as $sale)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $sale->created_at->format('d M Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $sale->customer_name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $sale->items->count() }} item(s)
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                Rp {{ number_format($sale->total_amount, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('sales.show', $sale) }}" class="text-green-600 hover:text-green-900">Lihat</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $sales->links() }}
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">Belum ada data penjualan</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>