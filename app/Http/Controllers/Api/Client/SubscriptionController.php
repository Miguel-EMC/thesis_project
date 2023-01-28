<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionCollection;
use App\Http\Resources\SubscriptionResource;
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
    public function store(Request $request)
    {
        if (auth()->id() != Product::find($request->product_id)->user_id) {
            return $this->sendResponse(
            message: 'You are not allowed to subscribe this product',
            code: 403,
            result: null
            );
        }
        $request->validate([
            'product_id' => [
                'required',
                'exists:products,id',
                function ($attribute, $value, $fail) {
                    $subscription = Subscription::where('product_id', $value)->where('status', 'active')->first();
                    if ($subscription) {
                        $fail('This product is already featured');
                    }
                }
            ]
        ]);
        $subscription = Subscription::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'payment_method' => 'paypal',
            'price' => 4.99,
        ]);
        $subscription->product->update([
            'featured' => true,
        ]);
        return $this->sendResponse(
        message: "Subscription created successfully",
        code: 201,
        result: [
                'subscription' => $subscription,
            ]
        );
    }

    // Funcion para obtener las suscripciones del usuario autenticado
    public function index()
    {
        $products = Product::where('user_id', auth()->id())->where('state', 1)->get();
        $subscriptions = Subscription::whereIn('product_id', $products->pluck('id'))->get();
        return $this->sendResponse(
        message: "Subscriptions returned successfully",
        result: [
                'subscriptions' => SubscriptionResource::collection($subscriptions),
            ]
        );
    }

}
