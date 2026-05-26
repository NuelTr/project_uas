<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $books = [
            [
                'title' => 'Laravel 10 untuk Pemula',
                'author' => 'John Doe',
                'publisher' => 'Penerbit Tekno',
                'year' => 2023,
                'isbn' => '978-602-1234-01-2',
                'stock' => 5,
                'description' => 'Buku panduan belajar Laravel dari dasar hingga mahir'
            ],
            [
                'title' => 'Pemrograman Web Modern',
                'author' => 'Jane Smith',
                'publisher' => 'Informatika',
                'year' => 2022,
                'isbn' => '978-602-1234-02-9',
                'stock' => 3,
                'description' => 'Membahas teknologi web terkini'
            ],
            [
                'title' => 'Database Design',
                'author' => 'Robert Martin',
                'publisher' => 'Andi Offset',
                'year' => 2021,
                'isbn' => '978-602-1234-03-6',
                'stock' => 4,
                'description' => 'Panduan merancang database yang efisien'
            ],
            [
                'title' => 'UI/UX Design Principles',
                'author' => 'Sarah Johnson',
                'publisher' => 'Elex Media',
                'year' => 2023,
                'isbn' => '978-602-1234-04-3',
                'stock' => 2,
                'description' => 'Prinsip dasar desain UI/UX'
            ],
            [
                'title' => 'Artificial Intelligence',
                'author' => 'Alan Turing',
                'publisher' => 'Gramedia',
                'year' => 2022,
                'isbn' => '978-602-1234-05-0',
                'stock' => 3,
                'description' => 'Pengantar kecerdasan buatan'
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}