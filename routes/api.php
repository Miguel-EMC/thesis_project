<?php

use App\Http\Controllers\Account\AvatarController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Api\Admin\CategorieController as AdminCategorieController;
use App\Http\Controllers\Api\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Api\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Api\Admin\CustomerController;
use App\Http\Controllers\Api\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Api\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\Api\Client\CategorieController;
use App\Http\Controllers\Api\Client\CommentController;
use App\Http\Controllers\Api\Client\MessageController;
use App\Http\Controllers\Api\Client\ProductController;
use App\Http\Controllers\Api\Client\ReportController;
use App\Http\Controllers\Api\Client\SubscriptionController;
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
                        Route::get('/{product}/view', 'showProducts')->name('products.showProducts');
                        Route::post('/{product}/update', 'update')->name('products.update');
                        Route::delete('/{product}', 'destroy')->name('products.destroy');
                        Route::get('/myProducts/list', 'indexProducts')->name('products.indexProducts');
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
            // Se hace uso de grupo de rutas para crear un reporte a un producto por parte del cliente
            Route::controller(ReportController::class)->group(
                function () {
                    Route::post('/{product}/reports', 'store')->name('products.reports.store');
                }
            );
            Route::post('search', [ProductController::class, 'search'])->name('products.search');
            Route::post('filter', [ProductController::class, 'filter'])->name('products.filter');
        }

    );
    // Se hace uso de grupo de rutas para el chat
    Route::controller(MessageController::class)->group(
        function () {
            Route::get('user/contacts', 'getContacts')->name('chat.getContacts');
            Route::get('user/{user}/messages', 'showMessages')->name('chat.showMessages');
            Route::post('user/send', 'sendMessage')->name('chat.sendMessage');
            Route::get('user/received', 'index')->name('chat.index');
        }
    );

    // Se hace uso de grupo de rutas para las suscripciones
    Route::controller(SubscriptionController::class)->group(
        function () {
            Route::get('subscriptions/', 'index')->name('subscriptions.index');
            Route::post('subscriptions/', 'store')->name('subscriptions.store');
        }
    );

    //Se crea  un grupo de rutas para el admin
    Route::prefix('admin')->group(
        function () {
            // Se hace uso de grupo de rutas para los clientes
            Route::controller(CustomerController::class)->group(
                function () {
                    Route::get('customers/', 'index')->name('customers.index');
                    Route::get('customers/{customer}', 'show')->name('customers.show');
                    Route::delete('customers/{customer}', 'destroy')->name('customers.destroy');
                }
            );
            // Se hace uso de grupo de rutas para las categorias
            Route::controller(AdminCategorieController::class)->group(
                function () {
                    Route::get('categories/', 'index')->name('categories.index');
                    Route::post('categories/', 'store')->name('categories.store');
                    Route::get('categories/{categorie}', 'show')->name('categories.show');
                    Route::put('categories/{categorie}', 'update')->name('categories.update');
                    Route::delete('categories/{categorie}', 'destroy')->name('categories.destroy');
                }
            );
            // Se hace uso de grupo de rutas para comentarios
            Route::controller(AdminCommentController::class)->group(
                function () {
                    Route::get('comments/', 'index')->name('comments.index');
                    Route::get('comments/{comment}', 'show')->name('comments.show');
                    Route::delete('comments/{comment}', 'destroy')->name('comments.destroy');
                }
            );
            // Se hace uso de grupo de rutas para los reportes
            Route::controller(AdminReportController::class)->group(
                function () {
                    Route::get('reports/', 'index')->name('reports.index');
                    Route::get('reports/{report}', 'show')->name('reports.show');
                    Route::post('reports/{report}', 'update')->name('reports.update');
                    Route::delete('reports/{report}', 'destroy')->name('reports.destroy');
                }
            );
            // Se hace uso de grupo de rutas para reportes de productos
            Route::controller(ReportController::class)->group(
                function () {
                    Route::get('/{product}/reports', 'index')->name('products.reports.index');
                    Route::get('/{product}/reports/{report}', 'show')->name('products.reports.show');
                    Route::delete('/{product}/reports/{report}', 'destroy')->name('products.reports.destroy');
                }
            );
            // Se hace uso de grupo de rutas para los productos
            Route::controller(AdminProductController::class)->group(
                function () {
                    Route::get('products/', 'index')->name('admin.products.index');
                    Route::get('products/{product}', 'show')->name('admin.products.show');
                    Route::delete('products/{product}', 'destroy')->name('admin.products.destroy');
                }
            );
            // Se hace uso de grupo de rutas para las suscripciones
            Route::controller(AdminSubscriptionController::class)->group(
                function () {
                    Route::get('subscriptions/', 'index')->name('admin.subscriptions.index');
                    Route::get('subscriptions/{subscription}', 'show')->name('admin.subscriptions.show');
                    Route::post('subscriptions/{subscription}', 'acceptSubscription')->name('admin.subscriptions.acceptSubscription');
                    Route::post('subscriptions/{subscription}/cancel', 'cancelSubscription')->name('admin.subscriptions.cancelSubscription');
                    Route::delete('subscriptions/{subscription}', 'destroy')->name('admin.subscriptions.destroy');
                }
            );

        }
    );
});

