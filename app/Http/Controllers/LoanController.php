<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'book'])
                    ->latest()
                    ->paginate(10);
        return view('admin.loans.index', compact('loans'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        $books = Book::all();
        return view('admin.loans.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after:loan_date',
        ]);

        $book = Book::find($request->book_id);
        
        // Cek ketersediaan buku
        $activeLoans = Loan::where('book_id', $request->book_id)
                          ->where('status', 'active')
                          ->count();
        
        if ($activeLoans >= $book->stock) {
            return back()->with('error', 'Stok buku tidak mencukupi');
        }

        Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date,
            'status' => 'active'
        ]);

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    public function returnBook(Loan $loan)
    {
        $loan->update([
            'return_date' => now(),
            'status' => 'returned'
        ]);

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan');
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Data peminjaman dihapus');
    }
}