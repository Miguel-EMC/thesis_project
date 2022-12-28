<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-subscription');
    }

    // Funcion para ver todos las suscripciones registrados en la base de datos
    public function index()
    {
        $subscriptions = Subscription::all();
        return $this->sendResponse(
            message: "Subscriptions returned successfully",
            code: 200,
            result: [
                'subscriptions' => $subscriptions,
            ]
        );
    }

    // Funcion para ver una suscripcion en especifico
    public function show(Subscription $subscription)
    {
        return $this->sendResponse(
            message: "Subscription returned successfully",
            code: 200,
            result: [
                'subscription' => $subscription,
            ]
        );
    }

    // Funcion para aceptar una suscripcion
    public function acceptSubscription(Subscription $subscription)
    {
        $product = $subscription->product;
        $subscription->status = "active";
        $product->featured = true;
        $product->save();
        $subscription->save();
        return $this->sendResponse(
            message: "Subscription accepted successfully",
            code: 200,
            result: [
                'subscription' => $subscription,
            ]
        );
    }

    // Funcion para cancelar una suscripcion
    public function cancelSubscription(Subscription $subscription)
    {
        $product = $subscription->product;
        $subscription->status = "canceled";
        $product->featured = false;
        $product->save();
        $subscription->save();
        return $this->sendResponse(
            message: "Subscription canceled successfully",
            code: 200,
            result: [
                'subscription' => $subscription,
            ]
        );
    }
}
