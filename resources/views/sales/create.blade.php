<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="post" action="{{ route('sales.store') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Cari Obat</label>
                        <input id="search" type="text" placeholder="Ketik nama atau kode obat" 
                               class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                               style="padding: 8px; border: 1px solid #ccc;">
                    </div>

                    <h3 class="text-lg font-semibold mb-4">Daftar Obat</h3>
                    <table id="items" class="w-full text-sm border-collapse mb-6">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">Obat</th>
                                <th class="border px-4 py-2 text-center">Jumlah</th>
                                <th class="border px-4 py-2 text-right">Harga Jual</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Pembayaran</label>
                        <input type="number" step="0.01" name="payment" placeholder="Jumlah pembayaran" 
                               class="mt-2 block w-full rounded-md border-gray-300 shadow-sm"
                               style="padding: 8px; border: 1px solid #ccc;">
                    </div>

                    <button type="submit" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Selesaikan Penjualan
                    </button>
                    <a href="{{ route('sales.index') }}" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 ml-2">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>

    <script>
        const search = document.getElementById('search');
        const tbody = document.querySelector('#items tbody');
        let idx = 0;

        search.addEventListener('input', async function(){
            const q = this.value.trim();
            if (!q || q.length < 2) return;
            
            try {
                const res = await fetch(`{{ route('medicines.search') }}?q=${encodeURIComponent(q)}`);
                const items = await res.json();
                
                if (items.length > 0) {
                    const m = items[0];
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="border px-4 py-2">${m.name}<input type="hidden" name="items[${idx}][medicine_id]" value="${m.id}"></td>
                        <td class="border px-4 py-2"><input type="number" name="items[${idx}][quantity]" value="1" min="1" max="${m.stock}" required style="width: 70px;"></td>
                        <td class="border px-4 py-2 text-right"><input type="number" step="0.01" name="items[${idx}][price]" value="${m.price_sale ?? 0}" required style="width: 100px;"></td>
                        <td class="border px-4 py-2 text-center"><button type="button" class="remove text-red-600 hover:text-red-800">Hapus</button></td>
                    `;
                    tbody.appendChild(tr);
                    tr.querySelector('.remove').addEventListener('click', ()=> tr.remove());
                    idx++;
                    search.value = '';
                }
            } catch (e) {
                console.error('Error:', e);
            }
        });
    </script>
</x-app-layout>
