<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kelola Peminjaman
            </h2>
            <a href="{{ route('admin.loans.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Peminjaman
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

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="min-w-full border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Peminjam</th>
                                <th class="px-4 py-2 border">Buku</th>
                                <th class="px-4 py-2 border">Tgl Pinjam</th>
                                <th class="px-4 py-2 border">Tenggat</th>
                                <th class="px-4 py-2 border">Tgl Kembali</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">Aksi</th>
                             </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                            <tr>
                                <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $loan->user->name }}</td>
                                <td class="px-4 py-2 border">{{ $loan->book->title }}</td>
                                <td class="px-4 py-2 border">{{ $loan->loan_date->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 border">
                                    <span class="{{ $loan->due_date->isPast() && $loan->status == 'active' ? 'text-red-600 font-bold' : '' }}">
                                        {{ $loan->due_date->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 border">{{ $loan->return_date ? $loan->return_date->format('d/m/Y') : '-' }}</td>
                                <td class="px-4 py-2 border">
                                    @if($loan->status == 'active')
                                        <span class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">Dipinjam</span>
                                    @else
                                        <span class="bg-green-500 text-white px-2 py-1 rounded text-sm">Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    @if($loan->status == 'active')
                                        <form action="{{ route('admin.loans.return', $loan) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded text-sm" onclick="return confirm('Proses pengembalian?')">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.loans.destroy', $loan) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-sm" onclick="return confirm('Hapus data?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $loans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>