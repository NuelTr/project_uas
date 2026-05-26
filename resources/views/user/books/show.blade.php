<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            @if($book->cover)
                                <img src="{{ Storage::url($book->cover) }}" class="w-full rounded">
                            @else
                                <div class="w-full h-96 bg-gray-200 flex items-center justify-center rounded">
                                    <span class="text-6xl">📚</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">{{ $book->title }}</h3>
                            <p class="mt-2"><strong>Pengarang:</strong> {{ $book->author }}</p>
                            <p><strong>Penerbit:</strong> {{ $book->publisher }}</p>
                            <p><strong>Tahun:</strong> {{ $book->year }}</p>
                            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                            <p><strong>Stok:</strong> {{ $book->stock }}</p>
                            <p><strong>Deskripsi:</strong> {{ $book->description ?: 'Tidak ada deskripsi' }}</p>
                            
                            <div class="mt-4">
                                @if($book->stock > 0)
                                    <form action="{{ route('user.books.borrow', $book) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin meminjam?')">
                                            Pinjam Buku
                                        </button>
                                    </form>
                                @else
                                    <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded" disabled>
                                        Stok Habis
                                    </button>
                                @endif
                                <a href="{{ route('user.books.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>