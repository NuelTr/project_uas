<!DOCTYPE html>
<html>
<head>
    <title>Test Buku</title>
</head>
<body>
    <h1>HALAMAN TEST BUKU</h1>
    
    <p>Jumlah Buku: {{ $books->count() }}</p>
    
    <ul>
    @foreach($books as $book)
        <li>{{ $book->title }} - {{ $book->author }} (Stok: {{ $book->stock }})</li>
    @endforeach
    </ul>
</body>
</html>