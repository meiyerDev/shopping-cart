<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->createMany([
            [
                'name' => 'Basic Tee - White',
                'price' => 40,
                'image' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-02.jpg'
            ],
            [
                'name' => 'Basic Tee - Black',
                'price' => 60,
                'image' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg'
            ],
            [
                'name' => 'Artwork Tee - Black',
                'price' => 80,
                'image' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-04.jpg'
            ]
        ]);
    }
}
