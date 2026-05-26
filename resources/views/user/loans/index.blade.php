<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Peminjaman Saya
        </h2>
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

                    <table class="min-w-full border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Buku</th>
                                <th class="px-4 py-2 border">Tgl Pinjam</th>
                                <th class="px-4 py-2 border">Tenggat</th>
                                <th class="px-4 py-2 border">Tgl Kembali</th>
                                <th class="px-4 py-2 border">Status</th>
                             </td>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                            <tr>
                                <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
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