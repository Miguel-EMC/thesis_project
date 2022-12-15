<?php

use App\Http\Controllers\Account\AvatarController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

    // Hacer uso del archivo auth.php
    require __DIR__ . '/auth.php';

    // Se hace uso de grupo de rutas y que pasen por el proceso de auth con sanctum
    Route::middleware(['auth:sanctum'])->group(function ()
    {
        // Se hace uso de grupo de rutas
        Route::prefix('profile')->group(function ()
        {
            Route::controller(ProfileController::class)->group(function ()
            {
                Route::get('/', 'show')->name('profile');
                Route::post('/', 'store')->name('profile.store');
            });
            Route::post('/avatar', [AvatarController::class, 'store'])->name('profile.avatar');
        });

        // Se hace uso de grupo de rutas
        Route::prefix('products')->group(function ()
        {
            Route::controller(ProductController::class)->group(function ()
            {
                Route::get('/', 'index')->name('products.index');
                Route::post('/', 'store')->name('products.store');
                Route::get('/{product}', 'show')->name('products.show');
                Route::put('/{product}', 'update')->name('products.update');
                Route::delete('/{product}', 'destroy')->name('products.destroy');
            });
            // Route::get('search/{title}', [ProductController::class, 'search'])->name('products.search');
            // Route::get('filter/{categorie}', [ProductController::class, 'filter'])->name('products.filter');
        });
    });



