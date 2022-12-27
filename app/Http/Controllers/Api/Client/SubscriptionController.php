<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create-subscription');
    }

    // Funcion para crear una suscripcion para que un usuario pueda colocar su producto en destacados
    public function store(Request $request){
        //Comprobamos que el producto pertenezca al usuario autenticado
        if (auth()->id() != Product::find($request->product_id)->user_id) {
            return $this->sendResponse(
                message: 'You are not allowed to subscribe this product',
                code: 403,
                result: null
            );
        }
        // Validamos los datos
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Creamos la suscripcion
        $subscription = Subscription::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'payment_method' => 'paypal',
            'price' => 4.99,
        ]);
        return $this->sendResponse(
            message: "Subscription created successfully",
            code: 201,
            result: [
                'subscription' => $subscription,
            ]
        );
    }
}
