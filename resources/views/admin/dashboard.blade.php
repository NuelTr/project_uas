@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Administrator')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card card-stats bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase mb-2">Total Buku</h6>
                            <h2 class="mb-0">{{ $totalBooks }}</h2>
                        </div>
                        <div class="rounded-circle bg-white-50 p-3">
                            <i class="fas fa-book fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-stats bg-gradient-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase mb-2">Total Anggota</h6>
                            <h2 class="mb-0">{{ $totalMembers }}</h2>
                        </div>
                        <div class="rounded-circle bg-white-50 p-3">
                            <i class="fas fa-users fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-stats bg-gradient-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase mb-2">Buku Dipinjam</h6>
                            <h2 class="mb-0">{{ $activeLoans }}</h2>
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
            <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Peminjaman Terbaru</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tenggat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentLoans as $loan)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-primary text-white me-2">
                                        {{ substr($loan->user->name, 0, 1) }}
                                    </div>
                                    {{ $loan->user->name }}
                                </div>
                            </td>
                            <td>{{ Str::limit($loan->book->title, 30) }}</td>
                            <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge {{ $loan->due_date->isPast() ? 'bg-danger' : 'bg-info' }}">
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
                            <td>
                                @if($loan->status == 'active')
                                    <form action="{{ route('loans.return', $loan) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Proses pengembalian buku?')">
                                            <i class="fas fa-undo"></i> Kembalikan
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                    Belum ada data peminjaman
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .bg-gradient-success {
        background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
    }
    .bg-gradient-warning {
        background: linear-gradient(135deg, #fda085 0%, #f6d365 100%);
    }
    .avatar-circle {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 10px;
    }
    .bg-white-50 {
        background: rgba(255,255,255,0.2);
    }
</style>
@endsection