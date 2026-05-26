<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        
        if (auth()->user()->role == 'admin') {
            $totalMembers = User::where('role', 'user')->count();
            $activeLoans = Loan::where('status', 'active')->count();
            $recentLoans = Loan::with(['user', 'book'])->latest()->take(5)->get();
            
            return view('dashboard', compact('totalBooks', 'totalMembers', 'activeLoans', 'recentLoans'));
        } else {
            $myActiveLoans = Loan::where('user_id', auth()->id())->where('status', 'active')->count();
            $myLoanHistory = Loan::where('user_id', auth()->id())->with('book')->latest()->take(5)->get();
            
            return view('dashboard-user', compact('totalBooks', 'myActiveLoans', 'myLoanHistory'));
        }
    }
}