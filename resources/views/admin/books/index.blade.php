<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manajemen Buku
            </h2>
            <a href="{{ route('admin.books.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Buku
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- TAMPILAN DATA BUKU -->
                    <div class="bg-blue-100 p-3 mb-4 rounded">
                        <strong>Total Buku: {{ $books->count() }}</strong>
                    </div>

                    @if($books->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 border text-left">No</th>
                                        <th class="px-4 py-2 border text-left">Judul Buku</th>
                                        <th class="px-4 py-2 border text-left">Pengarang</th>
                                        <th class="px-4 py-2 border text-left">Penerbit</th>
                                        <th class="px-4 py-2 border text-center">Stok</th>
                                        <th class="px-4 py-2 border text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $index => $book)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2 border">{{ $book->title }}</td>
                                        <td class="px-4 py-2 border">{{ $book->author }}</td>
                                        <td class="px-4 py-2 border">{{ $book->publisher }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $book->stock }}</td>
                                        <td class="px-4 py-2 border text-center">
                                            <a href="{{ route('admin.books.edit', $book) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin hapus?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8 bg-gray-100 rounded">
                            <p class="text-gray-500">Belum ada data buku. Silakan tambah buku baru.</p>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>