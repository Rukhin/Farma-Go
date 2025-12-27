<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add User Button -->
            <div class="mb-6">
                <a href="{{ route('users.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Tambah User
                </a>
            </div>

            <!-- Users Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($users->count() > 0)
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Email</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Role</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Terdaftar</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 font-semibold">{{ $user->name }}</td>
                                        <td class="px-4 py-3">{{ $user->email }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 text-xs font-semibold {{ $user->isAdmin() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }} rounded">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 text-sm">{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                                Edit
                                            </a>
                                            @if(!$user->isAdmin())
                                                <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline" 
                                                    onsubmit="return confirm('Hapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm ml-4">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6">
                            {{ $users->links() }}
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            Tidak ada user staff
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
