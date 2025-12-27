<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembelian ' . $purchase->invoice) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6 grid grid-cols-3 gap-4">
                        <div>
                            <p class="text-gray-600 text-sm">Supplier</p>
                            <p class="font-semibold">{{ $purchase->supplier->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Tanggal</p>
                            <p class="font-semibold">{{ $purchase->date->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">User</p>
                            <p class="font-semibold">{{ $purchase->user->name ?? '-' }}</p>
                        </div>
                    </div>

                    <table class="w-full text-sm border-collapse">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">Obat</th>
                                <th class="border px-4 py-2 text-right">Jumlah</th>
                                <th class="border px-4 py-2 text-right">Harga</th>
                                <th class="border px-4 py-2 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($purchase->items as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $item->medicine->name }}</td>
                                <td class="border px-4 py-2 text-right">{{ $item->quantity }}</td>
                                <td class="border px-4 py-2 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="border px-4 py-2 text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6 text-right border-t pt-4">
                        <h3 class="text-lg font-semibold">Total: Rp {{ number_format($purchase->total, 0, ',', '.') }}</h3>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('purchases.index') }}" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
