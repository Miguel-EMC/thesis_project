<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\ProductCollection;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return new ProductCollection(Product::paginate());
    }
    public function show(Product $product){
        return $product;
    }
    public function store(Request $request){
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }
    public function update(Request $request, Product $product){
        $product->update($request->all());
        return response()->json($product, 200);
    }
    public function delete(Product $product){
        $product->delete();
        return response()->json(null, 204);
    }
}