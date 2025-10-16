<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Category 1 ----
        $cat1 = Category::firstOrCreate(
            ['name' => 'Electronics'], // check by name
            ['description' => 'Latest gadgets and electronics devices']
        );

        $p1 = Product::firstOrCreate(
            ['name' => 'Smartphone'],
            ['description' => 'High-end Android smartphone with 128GB storage', 'price' => 35000]
        );

        $p2 = Product::firstOrCreate(
            ['name' => 'Laptop'],
            ['description' => 'Lightweight laptop with 8GB RAM and 512GB SSD', 'price' => 75000]
        );

        $p3 = Product::firstOrCreate(
            ['name' => 'Wireless Headphones'],
            ['description' => 'Noise cancelling Bluetooth headphones', 'price' => 12000]
        );

        // Attach products to category 1 (avoiding duplicates)
        $cat1->products()->syncWithoutDetaching([$p1->id, $p2->id, $p3->id]);


        // ---- Category 2 ----
        $cat2 = Category::firstOrCreate(
            ['name' => 'Fashion'],
            ['description' => 'Stylish clothing and accessories']
        );

        $p4 = Product::firstOrCreate(
            ['name' => 'Men T-Shirt'],
            ['description' => '100% cotton comfortable t-shirt', 'price' => 800]
        );

        $p5 = Product::firstOrCreate(
            ['name' => 'Women Dress'],
            ['description' => 'Elegant evening dress with premium fabric', 'price' => 2500]
        );

        $p6 = Product::firstOrCreate(
            ['name' => 'Leather Wallet'],
            ['description' => 'Genuine leather wallet with multiple compartments', 'price' => 1500]
        );

        // Attach products to category 2
        $cat2->products()->syncWithoutDetaching([$p4->id, $p5->id, $p6->id]);
    }
}
