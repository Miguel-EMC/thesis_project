<?php

namespace App\Http\Controllers\Api\Chat;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //Función para obtener los mensajes de un producto en específico
    //Recibe el id del producto
    // public function getMessages($id)
    // {
    //     //Obtener los mensajes del producto
    //     $messages = Message::where('product_id', $id)->get();
    //     //Retornar los mensajes
    //     return response()->json($messages);
    // }

    public function store(Request $request, Product $product)
    {

        //Crear el mensaje
        $message = $product->messages()->create([
            'message' => $request->input('message'),
        ]);

        broadcast(new MessageSent($product, $message))->toOthers();

        //Retornar el mensaje
        return ['status' => 'Message Sent!'] + $message->toArray();
    }
}
