<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_galleries = [
            [
                'products_id' => rand(1, 4),
                'url' => 'url/gallery/product',
            ],
            [
                'products_id' => rand(1, 4),
                'url' => 'url/gallery/product',
            ],
            [
                'products_id' => rand(1, 4),
                'url' => 'url/gallery/product',
            ],
            [
                'products_id' => rand(1, 4),
                'url' => 'url/gallery/product',
            ],
            [
                'products_id' => rand(1, 4),
                'url' => 'url/gallery/product',
            ],
            [
                'products_id' => rand(1, 4),
                'url' => 'url/gallery/product',
            ],
            [
                'products_id' => rand(1, 4),
                'url' => 'url/gallery/product',
            ],
            
            // ...
        ];

        DB::table('product_galleries')->insert($product_galleries);
    }
}
