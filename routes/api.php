<?php

use App\Http\Controllers\Account\AvatarController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Ruta pública para el registro de un nuevo usuario
Route::post('register/', [UserController::class, 'register'])->name('register');

// Ruta pública para el manejo de inicio de sesión del usuario
Route::post('login/', [UserController::class, 'authenticate'])->name('login');

// Ruta pública para mostrar todos los productos
Route::get('products/', [ProductController::class, 'index']);

// Rutas protegidas
Route::group(['middleware' => ['jwt.verify']], function () {
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

    // Rutas para el manejo de productos
    Route::get('products/{product}', [ProductController::class, 'show']);
    Route::post('products/', [ProductController::class, 'store']);
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'delete']);

    // Rutas para comentarios
    Route::get('products/{product}/comments/', [CommentController::class, 'index'])->name('comments.index');
    Route::get('products/{product}/comments/{comment}', [CommentController::class, 'show'])->name('comments.show');
    Route::post('products/{product}/comments/', [CommentController::class, 'store'])->name('comments.store');
    Route::put('products/{product}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('products/{product}/comments/{comment}', [CommentController::class, 'delete'])->name('comments.delete');
});