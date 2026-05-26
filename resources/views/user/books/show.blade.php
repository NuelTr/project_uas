@extends('layouts.app')

@section('title', $book->title)
@section('page-title', 'Detail Buku')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($book->cover)
                    <img src="{{ Storage::url($book->cover) }}" class="img-fluid rounded" alt="{{ $book->title }}">
                @else
                    <div class="bg-light py-5 rounded">
                        <i class="fas fa-book fa-5x text-secondary"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-3">{{ $book->title }}</h3>
                
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Pengarang</th>
                        <td>: {{ $book->author }}</td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: {{ $book->publisher }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: {{ $book->year }}</td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: {{ $book->isbn }}</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: {{ $book->stock }} buku</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
                            @if($book->isAvailable())
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Sedang Dipinjam</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>: {{ $book->description ?: 'Tidak ada deskripsi' }}</td>
                    </tr>
                </table>
                
                <div class="mt-3">
                    @if($book->isAvailable())
                        <form action="{{ route('user.books.borrow', $book) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg" onclick="return confirm('Yakin ingin meminjam buku ini?')">
                                <i class="fas fa-hand-holding-heart"></i> Pinjam Buku
                            </button>
                        </form>
                    @else
                        <button class="btn btn-secondary btn-lg" disabled>
                            <i class="fas fa-times-circle"></i> Stok Habis
                        </button>
                    @endif
                    
                    <a href="{{ route('user.books.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection