<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Katalog Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($books as $book)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        @if($book->cover)
                            <img src="{{ Storage::url($book->cover) }}" class="w-full h-48 object-cover rounded">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded">
                                <span class="text-4xl">📚</span>
                            </div>
                        @endif
                        <h3 class="font-bold mt-2">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600">Pengarang: {{ $book->author }}</p>
                        <p class="text-sm text-gray-600">Stok: {{ $book->stock }}</p>
                        <div class="mt-2">
                            <a href="{{ route('user.books.show', $book) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-4">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>