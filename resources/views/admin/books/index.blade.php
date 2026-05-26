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
                    <div class="bg-yellow-100 p-2 mb-4">
                     Total buku dari controller: {{ $books->count() }}
                    </div>
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($books->count() > 0)
                        <table class="min-w-full border">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 border">No</th>
                                    <th class="px-4 py-2 border">Cover</th>
                                    <th class="px-4 py-2 border">Judul Buku</th>
                                    <th class="px-4 py-2 border">Pengarang</th>
                                    <th class="px-4 py-2 border">Stok</th>
                                    <th class="px-4 py-2 border">Aksi</th>
                                </table>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                <tr>
                                    <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        @if($book->cover)
                                            <img src="{{ Storage::url($book->cover) }}" width="50" height="60" style="object-fit: cover;">
                                        @else
                                            <div class="bg-gray-200 text-center p-2" style="width: 50px; display: inline-block;">
                                                📚
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border">{{ $book->title }}</td>
                                    <td class="px-4 py-2 border">{{ $book->author }}</td>
                                    <td class="px-4 py-2 border text-center">{{ $book->stock }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <a href="{{ route('admin.books.edit', $book) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="mt-4">
                            {{ $books->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">Belum ada data buku. Silakan tambah buku baru.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>