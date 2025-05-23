<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;


// Главная страница — твоя кастомная Home.vue
Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


Route::get('/catalog', [ProductController::class, 'index'])->name('Catalog');
// Страница dashboard — доступна только авторизованным и подтверждённым
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Профиль и его маршруты
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
