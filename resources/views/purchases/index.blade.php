<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('purchases.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Tambah Pembelian
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Invoice</th>
                                <th class="px-4 py-2 text-left">Supplier</th>
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">Total</th>
                                <th class="px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchases as $p)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $p->invoice }}</td>
                                <td class="px-4 py-2">{{ $p->supplier->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $p->date->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('purchases.show', $p) }}" class="text-blue-600 hover:text-blue-800">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="px-4 py-2 text-center text-gray-500">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $purchases->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
