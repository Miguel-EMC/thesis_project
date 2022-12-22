<?php

use App\Http\Controllers\Account\AvatarController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Api\Client\CommentController;
use App\Http\Controllers\Api\Client\MessageController;
use App\Http\Controllers\Api\Client\ProductController;
use App\Http\Controllers\Api\Client\ReportController;
use Illuminate\Support\Facades\Route;

// Hacer uso del archivo auth.php
require __DIR__ . '/auth.php';

// Se hace uso de grupo de rutas y que pasen por el proceso de auth con sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    // Se hace uso de grupo de rutas
    Route::prefix('profile')->group(
        function () {
            Route::controller(ProfileController::class)->group(
                function () {
                        Route::get('/', 'show')->name('profile');
                        Route::post('/', 'store')->name('profile.store');
                    }
            );
            Route::post('/avatar', [AvatarController::class, 'store'])->name('profile.avatar');
        }
    );

    // Se hace uso de grupo de rutas
    Route::prefix('products')->group(
        function () {
            Route::controller(ProductController::class)->group(
                function () {
                        Route::get('/', 'index')->name('products.index');
                        Route::post('/', 'store')->name('products.store');
                        Route::get('/{product}', 'show')->name('products.show');
                        Route::put('/{product}', 'update')->name('products.update');
                        Route::delete('/{product}', 'destroy')->name('products.destroy');
                        Route::post('/myProducts', 'indexProducts')->name('products.indexProducts');
                    }
            );
            Route::controller(CommentController::class)->group(
                function () {
                        Route::get('/{product}/comments', 'index')->name('products.comments.index');
                        Route::get('/{product}/comments/{comment}', 'show')->name('products.comments.show');
                        Route::post('/{product}/comments', 'store')->name('products.comments.store');
                        Route::put('/{product}/comments/{comment}', 'update')->name('products.comments.update');
                        Route::delete('/{product}/comments/{comment}', 'destroy')->name('products.comments.destroy');
                    }
            );
            Route::post('search', [ProductController::class, 'search'])->name('products.search');
            Route::post('filter', [ProductController::class, 'filter'])->name('products.filter');

            // Se hace uso de grupo de rutas para reportes
            Route::controller(ReportController::class)->group(
                function () {
                    Route::get('/{product}/reports', 'index')->name('products.reports.index');
                    Route::get('/{product}/reports/{report}', 'show')->name('products.reports.show');
                    Route::post('/{product}/reports', 'store')->name('products.reports.store');
                    Route::delete('/{product}/reports/{report}', 'destroy')->name('products.reports.destroy');
                }
            );
        }

    );
    // Se hace uso de grupo de rutas para el chat
    Route::controller(MessageController::class)->group(
        function () {
            Route::get('user/contacts', 'getContacts')->name('chat.getContacts');
            Route::get('user/{user}/messages', 'showMessages')->name('chat.showMessages');
            Route::get('user/{user}/messages/{contact}', 'getMessages')->name('chat.getMessages');
            Route::post('user/send', 'sendMessage')->name('chat.sendMessage');
        }
    );
});