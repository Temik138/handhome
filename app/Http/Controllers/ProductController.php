<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia; 

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Catalog', [
            'products' => Product::all()->map(function ($product) {
                // Можно добавить обработку изображений тут, если Catalog этого требует
                // Например, если Catalog ожидает полный URL или обработанный массив images
                $product->image_url = $product->image ? asset('storage/' . $product->image) : null;
                $product->gallery_images = is_string($product->images)
                    ? json_decode($product->images, true)
                    : ($product->images ?? []);
                if (empty($product->gallery_images) && $product->image) {
                    $product->gallery_images = [$product->image];
                }
                return $product;
            })->toArray()
        ]);
    }

public function show($id)
{
    $product = Product::findOrFail($id);

    $images_array = [];
    if (is_string($product->images)) {
        $decoded_images = json_decode($product->images, true);
        $images_array = is_array($decoded_images) ? $decoded_images : [];
    } elseif (is_array($product->images)) {
        $images_array = $product->images;
    }

    if (empty($images_array) && !empty($product->image)) {
        $images_array = [$product->image];
    }

    $product_for_vue = [
        'id'          => $product->id,
        'name'        => $product->name,
        'description' => $product->description,
        'price'       => $product->price,
        'image'       => $product->image,
        'images'      => $images_array,
    ];

    return Inertia::render('Product', [
        'productData' => $product_for_vue
    ]);
}

    // МЕТОД для главной страницы
public function home()
{
    $displayProducts = Product::orderBy('id', 'asc')->take(3)->get()->map(function ($product) {
        // Убедитесь, что все поля существуют в вашей модели Product
        // и что нет опечаток (например, $product.->price было бы ошибкой, должно быть $product->price)
        return [
            'id'    => $product->id,
            'name'  => $product->name,
            'price' => $product->price, 
            'image' => $product->image,
        ];
    })->toArray();

    return Inertia::render('Home', [
        'featuredProducts' => $displayProducts
    ]);
}
}