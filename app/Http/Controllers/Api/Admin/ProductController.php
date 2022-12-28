<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view-product');
    }

    // Funcion para ver todos los productos registrados en la base de datos
    public function index()
    {
        $products = Product::all();
        return $this->sendResponse(
            message: "Products returned successfully",
            code: 200,
            result: [
                'products' => ProductResource::collection($products),
            ]
        );

    }
    public function show(Product $product)
    {
        return $this->sendResponse(
            message: "Product returned successfully",
            code: 200,
            result: [
                'product' => new ProductResource($product)
            ]
        );
    }
    //Funcion para eliminar un producto

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse(
            message: "Product deleted successfully",
            code: 200,
            result: []
        );
    }
}
