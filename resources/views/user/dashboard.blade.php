<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Peminjam
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-2xl font-bold text-blue-600">{{ $totalBooks }}</div>
                        <div class="text-gray-600">Total Buku Tersedia</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-2xl font-bold text-yellow-600">{{ $myActiveLoans }}</div>
                        <div class="text-gray-600">Buku yang Dipinjam</div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-4">Riwayat Peminjaman Terbaru</h3>
                    @if($myLoanHistory->count() > 0)
                        <table class="min-w-full border">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 border">Buku</th>
                                    <th class="px-4 py-2 border">Tgl Pinjam</th>
                                    <th class="px-4 py-2 border">Tenggat</th>
                                    <th class="px-4 py-2 border">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myLoanHistory as $loan)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $loan->book->title }}</td>
                                    <td class="px-4 py-2 border">{{ $loan->loan_date->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 border">{{ $loan->due_date->format('d/m/Y') }}</td>
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
                    @else
                        <p class="text-gray-500">Belum ada riwayat peminjaman</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>