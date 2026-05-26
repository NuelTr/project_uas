@extends('layouts.app')

@section('title', 'Kelola Peminjaman')
@section('page-title', 'Manajemen Peminjaman')

@section('content')
<div class="card table-custom">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-hand-holding-heart me-2"></i>Daftar Peminjaman</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLoanModal">
                <i class="fas fa-plus me-1"></i> Tambah Peminjaman
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tenggat</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $loan->user->name }}</td>
                        <td>{{ Str::limit($loan->book->title, 40) }}</td>
                        <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge {{ $loan->due_date->isPast() && $loan->status == 'active' ? 'bg-danger' : 'bg-info' }}">
                                {{ $loan->due_date->format('d/m/Y') }}
                            </span>
                        </td>
                        <td>{{ $loan->return_date ? $loan->return_date->format('d/m/Y') : '-' }}</td>
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
                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Proses pengembalian?')">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('loans.destroy', $loan) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data peminjaman?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                Belum ada data peminjaman
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

<!-- Modal Tambah Peminjaman -->
<div class="modal fade" id="addLoanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Peminjaman
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('loans.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Peminjam <span class="text-danger">*</span></label>
                        <select name="user_id" class="form-control" required>
                            <option value="">Pilih Peminjam</option>
                            @foreach($users ?? [] as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Buku <span class="text-danger">*</span></label>
                        <select name="book_id" class="form-control" required>
                            <option value="">Pilih Buku</option>
                            @foreach($books ?? [] as $book)
                                <option value="{{ $book->id }}">{{ $book->title }} (Stok: {{ $book->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                            <input type="date" name="loan_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tenggat <span class="text-danger">*</span></label>
                            <input type="date" name="due_date" class="form-control" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection