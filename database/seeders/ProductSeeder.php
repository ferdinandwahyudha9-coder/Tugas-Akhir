<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'nama' => 'MP x LC TRUE BLOOD',
                'deskripsi' => 'Kaos kolaborasi Manchester Prep x Lads Club dengan design TRUE BLOOD yang iconic',
                'harga' => 180000,
                'stok' => 25,
                'image' => 'tb1.jpeg',
                'label' => 'new',
                'category' => 'T-Shirt',
                'size' => 'L',
            ],
            [
                'nama' => 'Lads Club Moscow',
                'deskripsi' => 'Jersey Lads Club Moscow edition dengan bahan premium dan nyaman',
                'harga' => 260000,
                'stok' => 15,
                'image' => 'lc1.jpeg',
                'label' => 'hot',
                'category' => 'Jersey',
                'size' => 'L',
            ],
            [
                'nama' => 'FNF x PH',
                'deskripsi' => 'Kolaborasi eksklusif Football Not Football x PH dengan design limited edition',
                'harga' => 330000,
                'stok' => 10,
                'image' => 'bh1.jpeg',
                'label' => 'sale',
                'category' => 'Jersey',
                'size' => 'XL',
            ],
            [
                'nama' => 'James Boogie',
                'deskripsi' => 'Jersey retro James Boogie dengan kualitas premium dan desain klasik',
                'harga' => 450000,
                'stok' => 8,
                'image' => 'jb1.jpeg',
                'label' => 'best',
                'category' => 'Jersey',
                'size' => 'M',
            ],
            [
                'nama' => 'Casual Football Tee',
                'deskripsi' => 'Kaos casual football dengan design minimalis dan nyaman untuk daily wear',
                'harga' => 150000,
                'stok' => 30,
                'image' => 'default.jpg',
                'label' => 'new',
                'category' => 'T-Shirt',
                'size' => 'L',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['nama' => $product['nama']], // Cek berdasarkan nama
                $product
            );
        }
    }
}