<?php

namespace App\Http\Controllers\Api\Client;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactsResource;
use App\Http\Resources\ProfileResource;
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

    public function sendMessage(Request $request)
    {
        $this->authorize('create', Message::class);
        //creamos el mensaje
        $message = Message::create([
            'to' => $request->to,
            'message' => $request->message
        ]);
        //enviamos el mensaje
        event(new MessageSent($request->to, $request->message));
        //retornamos el mensaje
        return $this->sendResponse(
            message: 'Message sent',
            code: 200);
    }

    //Funcion para ver todos los mensajes enviados y recividos
    public function index(){
        $message = Message::where('from', Auth::user()->id)->orWhere('to', Auth::user()->id)->get();
        return $this->sendResponse(
            message: 'Messages',
            code: 200,
            result: [
                'messages' => $message
            ]);

    }

    //Funcion para ver solo los mensajes enviados y recibidos por el usuario logueado
    public function showMessages($user){

        $this->authorize('view', Message::class);

        $messages = Message::where('from', Auth::user()->id)->where('to', $user)->orWhere('from', $user)->where('to', Auth::user()->id)->get();
        if ($messages->isEmpty()) {
            return $this->sendResponse(
            message: 'You have no messages',
            code: 200,
            result: null
            );
        }
        return $this->sendResponse(
            message: 'Messages',
            code: 200,
            result: [
                'messages' => $messages
            ]);
    }

    //Funcion para ver los contactos de un usuario
    public function getContacts(){

        $this->authorize('viewContacts', Message::class);
        //Verificamos que el usuario tenga mensajes enviados o recibidos con los demas usuarios menos con el mismo
        $contacts = Message::where('from', Auth::user()->id)->orWhere('to', Auth::user()->id)->get();
        if ($contacts->isEmpty()) {
            return $this->sendResponse(
            message: 'You have no contacts',
            code: 200,
            result: null
            );
        }
        //Obtenemos los usuarios con los que ha hablado el usuario logueado menos con el mismo
        $contacts = User::whereIn('id', $contacts->pluck('from')->merge($contacts->pluck('to')))->where('id', '!=', Auth::user()->id)->get();
        //Retornamos los contactos del usuario logueado
        return $this->sendResponse(
            message: 'Contacts',
            code: 200,
            result: [
                'contacts' => ContactsResource::collection($contacts)
            ]);
    }
}
