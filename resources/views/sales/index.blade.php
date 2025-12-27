<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('sales.create') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    + Tambah Penjualan
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Invoice</th>
                                <th class="px-4 py-2 text-left">Kasir</th>
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">Total</th>
                                <th class="px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales as $s)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $s->invoice }}</td>
                                <td class="px-4 py-2">{{ $s->user->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $s->date->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">Rp {{ number_format($s->total, 0, ',', '.') }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('sales.show', $s) }}" class="text-blue-600 hover:text-blue-800">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="px-4 py-2 text-center text-gray-500">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
