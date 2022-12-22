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

    //Funcion para enviar mensajes a un usuario 
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message));

        return response()->json($message);
    }

    //Funcion para obtener los mensajes de un usuario
    public function getMessages(User $user)
    {
        $messages = Message::where('receiver_id', $user->id)->get();

        return response()->json($messages);
    }
    //Funcion para ver contactos del usuario
    public function getContacts(){
        $contacts = Message::where('receiver_id', auth()->user()->id)->get()->pluck('sender_id');
        $contacts = User::whereIn('id', $contacts)->whereHas('messages', function($query){
            $query->where('receiver_id', auth()->user()->id);
        })->get();

        //Retornamos los contactos del usuario logueado
        return response()->json($contacts);
    }
}
