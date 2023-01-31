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
        Product::create([
            'name'  => 'Dimond Nose Pin',
            'slug'  => 'dimond-nose-pin-1675144316',
            'price' => 200000,
            'weight' => 1.44,
            'karat' => 23,
            'stock' => 20,
            'description' => '<p>This is a description</p>',
            'images' => '["/uploads/products/1675144316.jpg"]',
            'published' => true,
        ]);
    }
}
