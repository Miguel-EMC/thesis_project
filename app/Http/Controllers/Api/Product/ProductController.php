<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCollection;
use App\Models\Product;

class ProductController extends Controller
{

    //Funcion para mostrar todos los productos de la base de datos
    public function index()
    {
        //Se obtiene todos los productos de la base de datos

        //Se invoca a la funcion padre
        return $this->sendResponse(
        message: "Products returned successfully",
        result: [
                'products' => new ProductCollection(Product::paginate(5)),
            ]
        );
    }

    //Funcion para mostrar un producto en especifico
    //Se recibe el id del producto
    public function show(Product $product)
    {
        //Se obtiene el producto de la base de datos
        //Se invoca a la funcion padre
        return $this->sendResponse(
        message: "Product returned successfully",
        result: [
                'product' => new ProductResource($product),
            ]
        );
    }

    //Funcion para crear un producto
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'price' => 'required|numeric',
            'detail' => 'required',
            'stock' => 'required|numeric',
            'state_appliance' => 'required|max:255',
            'delivery_method' => 'required|max:255',
            'brand' => 'required',
            'categorie_id' => 'required|exists:categories,id',
        ]);
        //Se crea el producto
        return response()->json([
            'message' => 'Product created successfully',
            'product' => Product::create($request->all())
        ]);
    }

    //Funcion para actualizar un producto
    public function update(Request $request, Product $product)
    {
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
        //Se actualiza el producto
        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product->update($request->all())
        ]);
    }

    public function destroy(Product $product)
    {
        //Se elimina el producto
        return response()->json([
            'message' => 'Product deleted successfully',
            'product' => $product->delete()
        ]);
    }

    // //Funcion para buscar un producto
    // public function search(Request $request)
    // {
    //     $products = Product::where('title', 'like', '%' . $request->name . '%')->get();
    //     return response()->json($products, 200);
    // }
    // //Funcion para filtrar productos
    // public function filter(Request $request)
    // {
    //     $query_products = Product::query();

    //     if ($request->has('price_min')) {
    //         $query_products->where('price_min', '>=', $request->price_min);
    //     }
    //     if ($request->has('price_max')) {
    //         $query_products->where('price_max', '<=', $request->price_max);
    //     }
    //     if ($request->has('state_appliance')) {
    //         $query_products->where('state_appliance', '=', $request->state_appliance);
    //     }
    //     if ($request->has('delivery_method')) {
    //         $query_products->where('delivery_method', '=', $request->delivery_method);
    //     }
    //     if ($request->has('brand')) {
    //         $query_products->where('brand', '=', $request->brand);
    //     }
    //     if ($request->has('categorie_id')) {
    //         $query_products->where('categorie_id', '=', $request->categorie_id);
    //     }
    //     if ($request->has('user_id')) {
    //         $query_products->where('user_id', '=', $request->user_id);
    //     }
    //     $products = $query_products->get();
    //     return response()->json($products, 200);
    // }

}