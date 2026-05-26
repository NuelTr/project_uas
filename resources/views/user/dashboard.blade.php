@extends('layouts.app')

@section('title', 'Dashboard Peminjam')
@section('page-title', 'Dashboard Peminjam')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card card-stats bg-gradient-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase mb-2">Total Buku Tersedia</h6>
                            <h2 class="mb-0">{{ $totalBooks }}</h2>
                        </div>
                        <div class="rounded-circle bg-white-50 p-3">
                            <i class="fas fa-book fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card card-stats bg-gradient-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase mb-2">Buku Dipinjam</h6>
                            <h2 class="mb-0">{{ $myActiveLoans }}</h2>
                        </div>
                        <div class="rounded-circle bg-white-50 p-3">
                            <i class="fas fa-hand-holding-heart fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card table-custom mt-4">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0"><i class="fas fa-history me-2"></i>Riwayat Peminjaman Terbaru</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tenggat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myLoanHistory as $loan)
                        <tr>
                            <td><strong>{{ $loan->book->title }}</strong></td>
                            <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge {{ $loan->due_date->isPast() && $loan->status == 'active' ? 'bg-danger' : 'bg-info' }}">
                                    {{ $loan->due_date->format('d/m/Y') }}
                                </span>
                            </td>
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
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                    Belum ada riwayat peminjaman
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('user.books.index') }}" class="btn btn-primary btn-lg px-5">
            <i class="fas fa-search me-2"></i> Cari Buku untuk Dipinjam
        </a>
    </div>
</div>

<style>
    .bg-gradient-info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    .bg-gradient-warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    .bg-white-50 {
        background: rgba(255,255,255,0.2);
    }
</style>
@endsection