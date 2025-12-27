<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penjualan ' . $sale->invoice) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 text-sm">Kasir</p>
                        <p class="font-semibold">{{ $sale->user->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tanggal</p>
                        <p class="font-semibold">{{ $sale->date->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <table class="w-full text-sm border-collapse mb-6">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Obat</th>
                            <th class="border px-4 py-2 text-right">Jumlah</th>
                            <th class="border px-4 py-2 text-right">Harga</th>
                            <th class="border px-4 py-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($sale->items as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->medicine->name }}</td>
                            <td class="border px-4 py-2 text-right">{{ $item->quantity }}</td>
                            <td class="border px-4 py-2 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="border-t pt-4">
                    <div class="grid grid-cols-3 gap-4 text-right">
                        <div>
                            <p class="text-gray-600 text-sm">Total</p>
                            <p class="text-xl font-semibold">Rp {{ number_format($sale->total, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Pembayaran</p>
                            <p class="text-xl font-semibold">Rp {{ number_format($sale->payment ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Kembalian</p>
                            <p class="text-xl font-semibold text-green-600">Rp {{ number_format(($sale->payment ?? 0) - $sale->total, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex gap-4">
                    <a href="{{ route('sales.index') }}" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Kembali
                    </a>
                    <a href="javascript:window.print()" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Cetak Struk
                    </a>
                    <a href="{{ route('sales.receipt-pdf', $sale) }}" class="inline-block px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        📥 Download PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
