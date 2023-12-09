<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products = [
            [
                'categories_id' => rand(1, 4),
                'name' => 'Adidas Ultraboost 21',
                'price' => 179.99,
                'description' => 'Premium running shoes with Boost technology for maximum comfort.',
                'tags' => 'running, sport, Adidas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_id' => rand(1, 4),
                'name' => 'Nike Air Max 270',
                'price' => 149.99,
                'description' => 'Iconic lifestyle sneakers with visible air cushioning.',
                'tags' => 'lifestyle, Nike, Air Max',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categories_id' => rand(1, 4),
                'name' => 'Puma Future Rider',
                'price' => 89.99,
                'description' => 'Retro-inspired sneakers with a modern twist.',
                'tags' => 'casual, Puma, Future Rider',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan entri lain sesuai dengan data produk sepatu yang nyata
            [
                'categories_id' => rand(1, 4),
                'name' => 'New Balance Fresh Foam X',
                'price' => 129.99,
                'description' => 'Versatile running shoes with Fresh Foam X technology.',
                'tags' => 'running, New Balance, Fresh Foam X',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ...
        ];

        DB::table('products')->insert($products);
    }
}
