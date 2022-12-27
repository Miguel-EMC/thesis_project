<?php

namespace App\Http\Controllers\Api\Client;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create-message');
    }

    //Funcion para enviar un mensaje a un usuario especifico
    public function sendMessage(Request $request)
    {
        $this->authorize('create', Message::class);

        $message = Message::create([
            'to' => $request->to,
            'message' => $request->message,
        ]);
        broadcast(new MessageSent($message));
        return $this->sendResponse(
            message: 'Message sent successfully',
            code: 200,
            result: [
                'message' => $message
            ]);
    }

    //Funcion para ver solo los mensajes enviados por un usuario
    public function showMessages($user)
    {
        $this->authorize('view', Message::class);
        //Comprobamos que el usuario que quiere ver los mensajes es el mismo que esta logueado
        if (Auth::user()->id != $user) {
            return $this->sendResponse(
            message: 'You are not allowed to see this messages',
            code: 403,
            result: null
            );
        }
        $sentMessages = Message::where('from', $user)->get();
        $receivedMessages = Message::where('to', $user)->get();
        //Devolvemos los mensajes enviados y recibidos
        return $this->sendResponse(
            message: 'Messages sent and received',
            code: 200,
            result: [
                'sentMessages' => $sentMessages,
                'receivedMessages' => $receivedMessages
        ]);
    }

    //Funcion para ver los contactos de un usuario
    public function getContacts(){

        $this->authorize('viewContacts', Message::class);

        //Verificamos que el usuario tenga mensajes enviados o recibidos con los demas usuarios
        $contacts = Message::where('from', Auth::user()->id)->orWhere('to', Auth::user()->id)->get();
        if ($contacts->isEmpty()) {
            return $this->sendResponse(
            message: 'You have no contacts',
            code: 200,
            result: null
            );
        }
        //Obtenemos los usuarios con los que ha hablado el usuario logueado
        $contacts = User::whereIn('id', $contacts->pluck('to'))->orWhereIn('id', $contacts->pluck('from'))->get();
        //Retornamos los contactos del usuario logueado
        return $this->sendResponse(
            message: 'Contacts',
            code: 200,
            result: [
                'contacts' => $contacts
        ]);
    }
}
