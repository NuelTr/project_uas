@extends('layouts.app')

@section('title', 'Data Buku')
@section('page-title', 'Manajemen Buku')

@section('content')
<div class="card table-custom">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-book me-2"></i>Daftar Buku</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">
            <i class="fas fa-plus me-1"></i> Tambah Buku
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Cover</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th width="8%">Stok</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($book->cover)
                                <img src="{{ Storage::url($book->cover) }}" width="50" height="60" style="object-fit: cover; border-radius: 5px;">
                            @else
                                <div class="bg-light text-center p-2" style="width: 50px; border-radius: 5px;">
                                    <i class="fas fa-book fa-2x text-secondary"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $book->title }}</strong><br>
                            <small class="text-muted">ISBN: {{ $book->isbn }}</small>
                        </td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher }} ({{ $book->year }})</td>
                        <td>
                            <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $book->stock }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="editBook({{ $book->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="fas fa-book-open fa-3x mb-3 d-block"></i>
                                Belum ada data buku
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0">
        <div class="d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    </div>
</div>

<!-- Modal Tambah Buku -->
<div class="modal fade" id="addBookModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Buku Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required>
                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pengarang <span class="text-danger">*</span></label>
                            <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" required>
                            @error('author') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penerbit <span class="text-danger">*</span></label>
                            <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror" required>
                            @error('publisher') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                            <input type="number" name="year" class="form-control @error('year') is-invalid @enderror" required>
                            @error('year') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ISBN <span class="text-danger">*</span></label>
                            <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror" required>
                            @error('isbn') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="1" required>
                            @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Cover Buku</label>
                            <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*">
                            @error('cover') <small class="text-danger">{{ $message }}</small> @enderror
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