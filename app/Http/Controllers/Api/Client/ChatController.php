<?php

namespace App\Http\Controllers\Api\Client;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Events\MessageSent as EventsMessageSent;

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

    // public function store(Request $request, Product $product)
    // {
    //     //Crear el mensaje
    //     $message = $product->messages()->create([
    //         'message' => $request->input('message'),
    //     ]);

    //     broadcast(new MessageSent($product, $message))->toOthers();

    //     //Retornar el mensaje
    //     return ['status' => 'Message Sent!'] + $message->toArray();
    // }

    //Funcion para crear un mensaje en un producto en específico y enviarlo a los usuarios conectados a ese producto
    //Recibe el id del producto y el mensaje 
    public function store(Request $request, Product $product)
    {
        //validar los datos
        $request->validate([
            'message' => 'required'
        ]);

        //Obtener el usuario que recibe el mensaje del producto en específico
        $user = Message::where('product_id', $product->id)->first()->user;
        $recipient = $user->recipient()->first();

        //Crear el mensaje
        $message = $product->messages()->create([
            'message' => $request->input('message'),
            'recipient_id' => $recipient->id
        ]);
    }
}
