<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Running Shoes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lifestyle Sneakers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Casual Shoes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan kategori lain sesuai dengan kategori produk sepatu yang nyata
            [
                'name' => 'Basketball Shoes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ...
        ];

        DB::table('product_categories')->insert($categories);
    }
}
