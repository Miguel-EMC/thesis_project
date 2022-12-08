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
        $request->validate([
            'title' => 'required|max:255',
            'price_min' => 'required|numeric',
            'price_max' => 'required|numeric',
            'detail' => 'required',
            'stock' => 'required|numeric',
            'state_appliance' => 'required|max:255',
            'delivery_method' => 'required|max:255',
            'brand' => 'required',
            'categorie_id' => 'required|exists:categories,id',
        ]);
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }
    public function update(Request $request, Product $product){
        $request->validate([
            'title' => 'required|max:255',
            'price_min' => 'required|numeric',
            'price_max' => 'required|numeric',
            'detail' => 'required',
            'stock' => 'required|numeric',
            'state_appliance' => 'required|max:255',
            'delivery_method' => 'required|max:255',
            'brand' => 'required',
            'categorie_id' => 'required|exists:categories,id',
        ]);
        $product->update($request->all());
        return response()->json($product, 200);
    }
    public function delete(Product $product){
        $product->delete();
        return response()->json(null, 204);
    }
}