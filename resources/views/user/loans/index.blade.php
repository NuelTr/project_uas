@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')
@section('page-title', 'Riwayat Peminjaman Saya')

@section('content')
<div class="card table-custom">
    <div class="card-header bg-white border-0 py-3">
        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Semua Peminjaman</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tenggat</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div>
                                <strong>{{ $loan->book->title }}</strong>
                                <br>
                                <small class="text-muted">ISBN: {{ $loan->book->isbn }}</small>
                            </div>
                        </td>
                        <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge {{ $loan->due_date->isPast() && $loan->status == 'active' ? 'bg-danger' : 'bg-info' }}">
                                {{ $loan->due_date->format('d/m/Y') }}
                            </span>
                            @if($loan->due_date->isPast() && $loan->status == 'active')
                                <br><small class="text-danger">Terlambat!</small>
                            @endif
                        </td>
                        <td>{{ $loan->return_date ? $loan->return_date->format('d/m/Y') : '-' }}</td>
                        <td>
                            @if($loan->status == 'active')
                                <span class="badge bg-warning">Dipinjam</span>
                            @else
                                <span class="badge bg-success">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                Belum ada riwayat peminjaman
                                <br>
                                <a href="{{ route('user.books.index') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-search"></i> Cari Buku
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0">
        <div class="d-flex justify-content-center">
            {{ $loans->links() }}
        </div>
    </div>
</div>
@endsection