<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Data Kategori / Genre Buku
        $fiksi = Category::create(['name' => 'Fiksi & Novel']);
        $nonFiksi = Category::create(['name' => 'Non-Fiksi & Pengembangan Diri']);
        $edukasi = Category::create(['name' => 'Edukasi & Pelajaran']);
        $komik = Category::create(['name' => 'Komik & Manga']);

        // 2. Buat Daftar Buku Berdasarkan Kategori Di Atas
        
        // Kategori: Fiksi & Novel
        Product::create([
            'category_id' => $fiksi->id,
            'code' => 'BK-FIK001',
            'name' => 'Laskar Pelangi - Andrea Hirata',
            'unit' => 'Ekslempar',
            'stock' => 25,
            'minimum_stock' => 5,
        ]);
        Product::create([
            'category_id' => $fiksi->id,
            'code' => 'BK-FIK002',
            'name' => 'Laut Bercerita - Leila S. Chudori',
            'unit' => 'Ekslempar',
            'stock' => 15,
            'minimum_stock' => 5,
        ]);

        // Kategori: Non-Fiksi & Pengembangan Diri
        Product::create([
            'category_id' => $nonFiksi->id,
            'code' => 'BK-NON001',
            'name' => 'Atomic Habits - James Clear',
            'unit' => 'Ekslempar',
            'stock' => 30,
            'minimum_stock' => 8,
        ]);
        Product::create([
            'category_id' => $nonFiksi->id,
            'code' => 'BK-NON002',
            'name' => 'Filosofi Teras - Henry Manampiring',
            'unit' => 'Ekslempar',
            'stock' => 20,
            'minimum_stock' => 5,
        ]);

        // Kategori: Edukasi & Pelajaran
        Product::create([
            'category_id' => $edukasi->id,
            'code' => 'BK-EDU001',
            'name' => 'Kamus Lengkap Inggris-Indonesia',
            'unit' => 'Ekslempar',
            'stock' => 10,
            'minimum_stock' => 3,
        ]);
        Product::create([
            'category_id' => $edukasi->id,
            'code' => 'BK-EDU002',
            'name' => 'Matematika Dasar untuk Perguruan Tinggi',
            'unit' => 'Ekslempar',
            'stock' => 8, // Sengaja di bawah minimum_stock untuk tes fitur "Stok Kritis"
            'minimum_stock' => 10,
        ]);

        // Kategori: Komik & Manga
        Product::create([
            'category_id' => $komik->id,
            'code' => 'BK-KMK001',
            'name' => 'One Piece Vol. 100',
            'unit' => 'Ekslempar',
            'stock' => 50,
            'minimum_stock' => 12,
        ]);
        Product::create([
            'category_id' => $komik->id,
            'code' => 'BK-KMK002',
            'name' => 'Detektif Conan Vol. 102',
            'unit' => 'Ekslempar',
            'stock' => 0, // Sengaja 0 untuk tes fitur "Stok Habis" di Dashboard
            'minimum_stock' => 5,
        ]);
    }
}