<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(12);
        return view('user.books.index', compact('books'));
    }

    public function show(Book $book)
    {
        return view('user.books.show', compact('book'));
    }

    public function borrow(Book $book)
    {
        // Cek apakah buku tersedia
        if (!$book->isAvailable()) {
            return back()->with('error', 'Maaf, stok buku sedang habis');
        }

        // Cek apakah user sudah meminjam buku ini
        $existingLoan = Loan::where('user_id', auth()->id())
                           ->where('book_id', $book->id)
                           ->where('status', 'active')
                           ->first();
        
        if ($existingLoan) {
            return back()->with('error', 'Anda sedang meminjam buku ini');
        }

        // Batasi maksimal 3 buku dipinjam
        $activeLoans = Loan::where('user_id', auth()->id())
                          ->where('status', 'active')
                          ->count();
        
        if ($activeLoans >= 3) {
            return back()->with('error', 'Maksimal peminjaman 3 buku');
        }

        // Proses peminjaman
        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'loan_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'active'
        ]);

        return redirect()->route('user.my-loans')->with('success', 'Buku berhasil dipinjam');
    }

    public function myLoans()
    {
        $loans = Loan::with('book')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->paginate(10);
        return view('user.loans.index', compact('loans'));
    }
}