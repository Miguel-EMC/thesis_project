<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    //Funcion para verificar si el usuario tiene permiso para acceder a los productos
    //Se verifica si el usuario tiene el rol de customer
    //Si el usuario no tiene el rol de customer se le deniega el acceso
    //Si el usuario tiene el rol de customer se le permite el acceso
    public function __construct()
    {
        $this->middleware('can:manage-product');
    }

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
        $response = Gate::inspect('create', Product::class);

        if ($response->allowed()) {
        //Se valida la informacion del producto
            $request->validate([
                'title' => 'required|max:255',
                'price' => 'required|numeric',
                'detail' => 'required',
                'stock' => 'required|numeric',
                'state_appliance' => 'required|max:255',
                'delivery_method' => 'required|max:255',
                'brand' => 'required',
                'categorie_id' => 'required|exists:categories,id',
                'image' => 'required|image| mimes:jpg,png,jpeg|max:512'
            ]);

            //Se crea el producto
            $product = new Product($request->all());
            $path = $request->file('image')->store('products', 'dropbox');
            $product->image = $path;
            $product->save();
            return $this->sendResponse(
                message: 'Product created successfully',
                result: [
                    'product' => new ProductResource($product),
                ]
            );
        } else {
            return $this->sendError(
                message: 'You are not allowed to create products.',
                Result: [
                    'product' => $response->message(),
                ],
                code: 403
            );
        }
    }
    //Funcion para obligar a descargar una imagen de un producto
    public function image(Product $product)
    {
        //retorna la imagen del producto de la base de datos en formato de descarga
        return Storage::disk('dropbox')->download($product->image);
    }

    //Funcion para actualizar un producto
    public function update(Request $request, Product $product)
    {
        $response = Gate::inspect('update', $product);

        if ($response->allowed()) {

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
            //Se actualiza el producto
            return response()->json([
                'message' => 'Product updated successfully',
                'product' => $product->update($request->all())
            ]);
        } else {
            return response()->json([
                'message' => $response->message(),
            ], 403);
        }
    }

    //Funcion para eliminar un producto
    public function destroy(Product $product)
    {
        $response = Gate::inspect('delete', $product);
        if ($response->denied()) {
            return response()->json([
                'message' => $response->message(),
            ], 403);
        }
        //Se elimina el producto
        return response()->json([
            'message' => 'Product deleted successfully',
            'product' => $product->delete()
        ]);
    }

    //Funcion para buscar un producto
    public function search(Request $request)
    {
        //Se valida la informacion del producto
        $request->validate([
            'title' => 'required|max:255',
        ]);
        //Se busca el producto
        $product = Product::where('title', 'like', '%' . $request->title . '%')->get();
        //Se invoca a la funcion padre
        return $this->sendResponse(
        message: "Product returned successfully",
        result: [
                'product' => new ProductCollection($product),
            ]
        );
    }

    //Funcion para filtrar productos
    public function filter(Request $request, Product $product)
    {
        if ($request->id){
            $product = $product->where('id', $request->id);
        }
        if ($request->title){
            $product = $product->where('title', $request->title);
        }
        if ($request->price_min){
            $product = $product->where('price', '>=', $request->price_min);
        }
        if ($request->price_max){
            $product = $product->where('price', '<=', $request->price_max);
        }
        if ($request->stock){
            $product = $product->where('stock', $request->stock);
        }
        if ($request->state_appliance){
            $product = $product->where('state_appliance', $request->state_appliance);
        }
        if ($request->delivery_method){
            $product = $product->where('delivery_method', $request->delivery_method);
        }
        if ($request->brand){
            $product = $product->where('brand', $request->brand);
        }
        if ($request->categorie_id){
            $product = $product->where('categorie_id', $request->categorie_id);
        }
        //Se invoca a la funcion padre
        return $this->sendResponse(
            message: "Product filtered successfully",
            result: [
                    'product' => $product->get(),
                ]
            );
    }
}