<?php

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
    Route::get('user/', [UserController::class, 'getAuthenticatedUser']);
    Route::get('products/{product}', [ProductController::class, 'show']);
    Route::post('products/', [ProductController::class, 'store']);
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'delete']);
});