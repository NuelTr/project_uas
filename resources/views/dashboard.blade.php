<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Administrator
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-2xl font-bold text-blue-600">{{ $totalBooks }}</div>
                        <div class="text-gray-600">Total Buku</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-2xl font-bold text-green-600">{{ $totalMembers }}</div>
                        <div class="text-gray-600">Total Anggota</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-2xl font-bold text-yellow-600">{{ $activeLoans }}</div>
                        <div class="text-gray-600">Buku Dipinjam</div>
                    </div>
                </div>
            </div>

            <!-- Recent Loans -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-4">Peminjaman Terbaru</h3>
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="text-left">Peminjam</th>
                                <th class="text-left">Buku</th>
                                <th class="text-left">Tgl Pinjam</th>
                                <th class="text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentLoans as $loan)
                            <tr>
                                <td>{{ $loan->user->name }}</td>
                                <td>{{ $loan->book->title }}</td>
                                <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                                <td>
                                    @if($loan->status == 'active')
                                        <span class="text-yellow-600">Dipinjam</span>
                                    @else
                                        <span class="text-green-600">Dikembalikan</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>