<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Form -->
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="GET" action="{{ route('reports.purchases') }}" class="flex gap-4 flex-wrap">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" 
                            class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" 
                            class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Cari
                        </button>
                        <a href="{{ route('reports.purchases') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Reset
                        </a>
                        <a href="{{ route('reports.purchases-pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" 
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            📥 Export PDF
                        </a>
                    </div>
                </form>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Total Transaksi</div>
                    <div class="text-3xl font-bold text-blue-600 mt-2">{{ $summary->total_transactions ?? 0 }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Total Pembelian</div>
                    <div class="text-3xl font-bold text-green-600 mt-2">Rp {{ number_format($summary->total_amount ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($purchases->count() > 0)
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Invoice</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Supplier</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Item</th>
                                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Total</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $purchase)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 font-mono text-blue-600">{{ $purchase->invoice }}</td>
                                        <td class="px-4 py-3">{{ $purchase->supplier?->name ?? '-' }}</td>
                                        <td class="px-4 py-3">{{ $purchase->date?->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3 text-gray-600 text-sm">{{ $purchase->items->count() }} item</td>
                                        <td class="px-4 py-3 text-right font-semibold">Rp {{ number_format($purchase->total, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('purchases.show', $purchase) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                                Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6">
                            {{ $purchases->links() }}
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            Tidak ada data pembelian untuk periode ini
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
