@extends('layouts.app')

@section('title', 'Daftar Buku')
@section('page-title', 'Katalog Buku')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.books.index') }}" method="GET" class="row g-3">
                    <div class="col-md-10">
                        <input type="text" name="search" class="form-control form-control-lg" 
                               placeholder="Cari judul buku, pengarang, atau penerbit..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @forelse($books as $book)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="position-relative">
                @if($book->cover)
                    <img src="{{ Storage::url($book->cover) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 250px; object-fit: cover;">
                @else
                    <div class="bg-light text-center py-5" style="height: 250px;">
                        <i class="fas fa-book fa-4x text-secondary"></i>
                    </div>
                @endif
                <span class="badge {{ $book->isAvailable() ? 'bg-success' : 'bg-danger' }} position-absolute top-0 end-0 m-2">
                    {{ $book->isAvailable() ? 'Tersedia' : 'Sedang Dipinjam' }}
                </span>
            </div>
            <div class="card-body">
                <h6 class="card-title">{{ Str::limit($book->title, 40) }}</h6>
                <p class="card-text small text-muted mb-1">
                    <i class="fas fa-user"></i> {{ $book->author }}
                </p>
                <p class="card-text small text-muted">
                    <i class="fas fa-building"></i> {{ $book->publisher }}
                </p>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="badge bg-info">Stok: {{ $book->stock }}</span>
                    @if($book->isAvailable())
                        <a href="{{ route('user.books.show', $book) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-hand-holding-heart"></i> Pinjam
                        </a>
                    @else
                        <button class="btn btn-sm btn-secondary" disabled>
                            <i class="fas fa-times-circle"></i> Habis
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center py-5">
            <i class="fas fa-search fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">Buku tidak ditemukan</h5>
            <p class="text-muted">Coba dengan kata kunci yang berbeda</p>
        </div>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $books->withQueryString()->links() }}
</div>
@endsection