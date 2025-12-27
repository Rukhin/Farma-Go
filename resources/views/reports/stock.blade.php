<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Stok Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter -->
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="GET" action="{{ route('reports.stock') }}" class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="below_min" value="1" 
                            {{ $showOnlyBelowMin ? 'checked' : '' }}
                            class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                        <span class="text-sm font-medium text-gray-700">Tampilkan hanya stok di bawah minimum</span>
                    </label>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Filter
                    </button>
                    <a href="{{ route('reports.stock-pdf', ['below_min' => $showOnlyBelowMin ? 1 : 0]) }}" 
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        📥 Export PDF
                    </a>
                </form>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Total Obat</div>
                    <div class="text-3xl font-bold text-blue-600 mt-2">{{ $summary['total_medicines'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Di Bawah Minimum</div>
                    <div class="text-3xl font-bold text-orange-600 mt-2">{{ $summary['below_minimum'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Stok Habis</div>
                    <div class="text-3xl font-bold text-red-600 mt-2">{{ $summary['out_of_stock'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm">Nilai Stok</div>
                    <div class="text-2xl font-bold text-green-600 mt-2">Rp {{ number_format($summary['total_stock_value'], 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($medicines->count() > 0)
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Kode</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama Obat</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori</th>
                                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Stok</th>
                                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Min. Stok</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($medicines as $medicine)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 font-mono font-semibold">{{ $medicine->code }}</td>
                                        <td class="px-4 py-3">{{ $medicine->name }}</td>
                                        <td class="px-4 py-3 text-gray-600 text-sm">{{ $medicine->category?->name ?? '-' }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <span class="font-semibold">{{ $medicine->stock }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-right">{{ $medicine->min_stock }}</td>
                                        <td class="px-4 py-3 text-center">
                                            @if($medicine->stock == 0)
                                                <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">Habis</span>
                                            @elseif($medicine->stock < $medicine->min_stock)
                                                <span class="px-3 py-1 text-xs font-semibold bg-orange-100 text-orange-800 rounded-full">Rendah</span>
                                            @else
                                                <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Normal</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6">
                            {{ $medicines->links() }}
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            Tidak ada data stok obat
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
