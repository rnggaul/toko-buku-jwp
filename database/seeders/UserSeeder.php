<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menyuntikkan data admin pertama ke dalam tabel users
        User::create([
            'name' => 'Admin Toko Buku JWP',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
        ]);
    }
}