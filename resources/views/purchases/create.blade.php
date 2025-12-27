<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pembelian') }}
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
                <form method="post" action="{{ route('purchases.store') }}">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Supplier</label>
                        <select name="supplier_id" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm"
                                style="padding: 8px; border: 1px solid #ccc;">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suppliers as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}"
                               class="mt-2 block w-full rounded-md border-gray-300 shadow-sm"
                               style="padding: 8px; border: 1px solid #ccc;">
                    </div>

                    <h3 class="text-lg font-semibold mb-4">Daftar Obat</h3>
                    <table id="items" class="w-full text-sm border-collapse mb-6">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">Obat</th>
                                <th class="border px-4 py-2 text-center">Jumlah</th>
                                <th class="border px-4 py-2 text-right">Harga Beli</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <button type="button" id="add" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 mb-6">
                        + Tambah Baris
                    </button>

                    <div class="flex gap-4">
                        <button type="submit" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan Pembelian
                        </button>
                        <a href="{{ route('purchases.index') }}" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const medicines = @json($medicines->map(fn($m)=>['id'=>$m->id,'name'=>$m->name,'price'=> (float)$m->price_purchase]));
        let itemIndex = 0;

        document.getElementById('add').addEventListener('click', ()=>{
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="border px-4 py-2">
                    <select name="items[${itemIndex}][medicine_id]" required style="width: 100%; padding: 4px;">
                        <option value="">-- Pilih Obat --</option>
                        ${medicines.map(m=>`<option value="${m.id}">${m.name}</option>`).join('')}
                    </select>
                </td>
                <td class="border px-4 py-2"><input type="number" name="items[${itemIndex}][quantity]" value="1" min="1" required style="width: 70px;"></td>
                <td class="border px-4 py-2 text-right"><input type="number" step="0.01" name="items[${itemIndex}][price]" value="0" min="0" required style="width: 100px;"></td>
                <td class="border px-4 py-2 text-center"><button type="button" class="remove text-red-600 hover:text-red-800">Hapus</button></td>
            `;
            document.querySelector('#items tbody').appendChild(tr);
            tr.querySelector('.remove').addEventListener('click', ()=> tr.remove());
            itemIndex++;
        });
    </script>
</x-app-layout>
