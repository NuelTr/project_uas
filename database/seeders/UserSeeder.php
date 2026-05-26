<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@perpustakaan.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta'
        ]);

        // 3 User Peminjam
        $users = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@email.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '081234567891',
                'address' => 'Jl. Mawar No. 2, Bandung'
            ],
            [
                'name' => 'Ani Wijaya',
                'email' => 'ani@email.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '081234567892',
                'address' => 'Jl. Melati No. 3, Surabaya'
            ],
            [
                'name' => 'Citra Dewi',
                'email' => 'citra@email.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '081234567893',
                'address' => 'Jl. Anggrek No. 4, Yogyakarta'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}