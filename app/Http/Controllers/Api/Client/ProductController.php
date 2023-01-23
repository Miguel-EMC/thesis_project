<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductCreatedNotification;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

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
        return $this->sendResponse(
        message: "Products returned successfully",
        result: [
                'products' => new ProductCollection(Product::paginate(12)),
                'pagination' => [
                    'total' => Product::count(),
                    'per_page' => 12,
                    'current_page' => 1,
                    'last_page' => ceil(Product::count() / 12),
                    'from' => 1,
                    'to' => 12,
                ],
            ]
        );
    }

    //Funcion para mostrar un producto en especifico
    //Se recibe el id del producto
    public function show(Product $product)
    {
        $product = Product::active()->find($product->id);
        if (!$product) {
            return $this->sendResponse(
            message: "Product not found",
            code: 404
            );
        }
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
        //Se valida la informacion del producto
        $request->validate([
            'title' => 'required|max:50|min:5',
            'price' => 'required|numeric|min:1|max:100000',
            'detail' => 'required',
            'stock' => 'required|numeric|min:1|max:100000',
            'state_appliance' => 'required|max:255',
            'delivery_method' => 'required|max:255',
            'brand' => 'required|max:20|min:2',
            'address' => 'required|max:50|min:5',
            'phone' => 'required|numeric|max:9999999999|min:1000000',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'required|image'
        ]);
        $file = $request->file('image');
        $obj = Cloudinary::upload($file->getRealPath(), ['folder' => 'products']);
        $image_url = $obj->getSecurePath();

        //creamos el producto
        $product = Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'detail' => $request->detail,
            'stock' => $request->stock,
            'state_appliance' => $request->state_appliance,
            'delivery_method' => $request->delivery_method,
            'brand' => $request->brand,
            'address' => $request->address,
            'phone' => $request->phone,
            'categorie_id' => $request->categorie_id,
            'image' => $image_url,
        ]);
        return $this->sendResponse(
        message: 'Product created successfully',
        code: 201,
        result: [
                'product' => new ProductResource($product),
            ]
        );
    }

    //Funcion para actualizar un producto
    public function update(Request $request, Product $product)
    {
        //Se valida la informacion del producto
        $this->authorize('update', $product);
        $product = Product::active()->find($product->id);
        if (!$product) {
            return $this->sendResponse(
            message: "Product not found",
            code: 404
            );
        }
        $request->validate([
            'title' => 'required|max:50|min:5',
            'price' => 'required|numeric|min:1|max:100000',
            'detail' => 'required',
            'stock' => 'required|numeric|min:1|max:100000',
            'state_appliance' => 'required|max:255',
            'delivery_method' => 'required|max:255',
            'brand' => 'required|max:20|min:2',
            'address' => 'required|max:50|min:5',
            'phone' => 'required|numeric|max:9999999999|min:1000000',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'required|image'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $obj = Cloudinary::upload($file->getRealPath(), ['folder' => 'products']);
            $image_url = $obj->getSecurePath();
        }

        //Se actualiza el producto
        $product->update([
            'title' => $request->title,
            'price' => $request->price,
            'detail' => $request->detail,
            'stock' => $request->stock,
            'state_appliance' => $request->state_appliance,
            'delivery_method' => $request->delivery_method,
            'brand' => $request->brand,
            'address' => $request->address,
            'phone' => $request->phone,
            'categorie_id' => $request->categorie_id,
            'image' => $image_url,
        ]);
        return $this->sendResponse(
        message: 'Product updated successfully',
        code: 200,
        result: [
                'product' => new ProductResource($product),
            ]
        );
    }
    //Funcion para eliminar un producto
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        //Se elimina el producto
        $product->update([
            'state' => 0,
        ]);
        //Se invoca a la funcion padre
        return $this->sendResponse(
        message: "Product deleted successfully",
        code: 200,
        result: [
            ]
        );
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
        code: 200,
        result: [
                'product' => new ProductCollection($product),
            ]
        );
    }

    //Funcion para filtrar productos
    public function filter(Request $request, Product $product)
    {
        if ($request->id) {
            $product = $product->where('id', $request->id);
        }
        if ($request->title) {
            $product = $product->where('title', $request->title);
        }
        if ($request->price_min) {
            $product = $product->where('price', '>=', $request->price_min);
        }
        if ($request->price_max) {
            $product = $product->where('price', '<=', $request->price_max);
        }
        if ($request->stock) {
            $product = $product->where('stock', $request->stock);
        }
        if ($request->state_appliance) {
            $product = $product->where('state_appliance', $request->state_appliance);
        }
        if ($request->delivery_method) {
            $product = $product->where('delivery_method', $request->delivery_method);
        }
        if ($request->brand) {
            $product = $product->where('brand', $request->brand);
        }
        if ($request->address) {
            $product = $product->where('address', $request->address);
        }
        if ($request->categorie_id) {
            $product = $product->where('categorie_id', $request->categorie_id);
        }
        //Se invoca a la funcion padre
        return $this->sendResponse(
        message: "Product filtered successfully",
        code: 200,
        result: [
                'product' => new ProductCollection($product->paginate(12)),
                'pagination' => [
                    'total' => Product::count(),
                    'per_page' => 12,
                    'current_page' => 1,
                    'last_page' => ceil(Product::count() / 12),
                    'from' => 1,
                    'to' => 12,
                ],
            ]
        );
    }
    //Funcion que permite observar los productos creados por un usuario en especifico
    public function indexProducts(Request $request)
    {
        $user = $request->user();
        $products = Product::where('user_id', $user->id)->active()->get();
        return $this->sendResponse(
        message: "Products returned successfully",
        code: 200,
        result: [
                'products' => new ProductCollection($products),
            ]
        );
    }

    //Funcion para ver los productos de un usuario en especifico
    public function showProducts(Request $request, Product $product)
    {
        //verificar si el usuario es el dueño del producto
        $this->authorize('view', $product);
        $product = Product::active()->find($product->id);
        if (!$product) {
            return $this->sendResponse(
            message: "Product not found",
            code: 404
            );
        }
        return $this->sendResponse(
        message: "Product returned successfully",
        result: [
                'product' => new ProductResource($product),
            ]
        );
    }

    //Funcion para enviar notificacion a un usuario que creo un producto
    public function sendNotification(Product $product)
    {
        $user = User::find($product->user_id);
        $user->notify(
            new ProductCreatedNotification(
                product_name: $product->title,
            )
        );
    }
}
