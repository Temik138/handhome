<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Курс по реакту',
                'description' => 'Полный курс по React.js',
                'price' => 800,
                'image' => 'kursreact.webp',
                'images' => json_encode(['kursreact.webp', 'kursreact2.webp']),
                'category' => 'kurs',
                'is_popular' => true
            ],
             [
                'name' => 'Курс по js',
                'description' => 'Полный курс по js',
                'price' => 500,
                'image' => 'kursjs.webp',
                'images' => json_encode(['kursjs.webp', 'kursjs.webp']),
                'category' => 'kurs',
                'is_popular' => true
            ],
             [
                'name' => 'Книга Гарри Поттер',
                'description' => 'Полный курс по React.js',
                'price' => 480,
                'image' => 'garry.webp',
                'images' => json_encode(['garry.webp', 'garry2.webp']),
                'category' => 'books',
                'is_popular' => true
            ],
             [
                'name' => 'Книга Властелин Колец',
                'description' => 'Полный курс по React.js',
                'price' => 420,
                'image' => 'kolec.webp',
                'images' => json_encode(['kolec.webp', 'kolec2.webp']),
                'category' => 'books',
                'is_popular' => true
            ],
          
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}