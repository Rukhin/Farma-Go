<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Form -->
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="GET" action="{{ route('reports.sales') }}" class="flex gap-4 flex-wrap">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" 
                            class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" 
                            class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Cari
                        </button>
                        <a href="{{ route('reports.sales') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Reset
                        </a>
                        <a href="{{ route('reports.sales-pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" 
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            📥 Export PDF
                        </a>
                    </div>
                </form>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Total Transaksi</div>
                    <div class="text-3xl font-bold text-green-600 mt-2">{{ $summary->total_transactions ?? 0 }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Total Penjualan</div>
                    <div class="text-3xl font-bold text-green-600 mt-2">Rp {{ number_format($summary->total_amount ?? 0, 0, ',', '.') }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Total Kembalian</div>
                    <div class="text-3xl font-bold text-orange-600 mt-2">Rp {{ number_format($summary->total_change ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($sales->count() > 0)
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Invoice</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Kasir</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Item</th>
                                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Total</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 font-mono text-green-600">{{ $sale->invoice }}</td>
                                        <td class="px-4 py-3">{{ $sale->user->name }}</td>
                                        <td class="px-4 py-3">{{ $sale->date?->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-3 text-gray-600 text-sm">{{ $sale->items->count() }} item</td>
                                        <td class="px-4 py-3 text-right font-semibold">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('sales.show', $sale) }}" class="text-green-600 hover:text-green-800 text-sm">
                                                Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6">
                            {{ $sales->links() }}
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            Tidak ada data penjualan untuk periode ini
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
