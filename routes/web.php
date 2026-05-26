<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\UserBookController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Route untuk admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('books', BookController::class);
    Route::resource('loans', LoanController::class);
    Route::put('loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');
});

// Route untuk user biasa
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('books', [UserBookController::class, 'index'])->name('books.index');
    Route::get('books/{book}', [UserBookController::class, 'show'])->name('books.show');
    Route::post('books/{book}/borrow', [UserBookController::class, 'borrow'])->name('books.borrow');
    Route::get('my-loans', [UserBookController::class, 'myLoans'])->name('my-loans');
});

// Route profile sederhana
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile.edit');
});

require __DIR__.'/auth.php';