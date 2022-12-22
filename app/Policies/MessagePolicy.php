<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class MessagePolicy
{
    use HandlesAuthorization;

    //Funcion para enviar mensajes a un usuario 
    public function create(User $user)
    {
        return $user->role->slug === "customer"
        ? Response::allow()
        : Response::deny('You are not allowed to send messages');
    }
    //Funcion para ver los mensajes de un usuario
    public function view(User $user)
    {
        return $user->role->slug === "customer"
        ? Response::allow()
        : Response::deny('You are not allowed to see this messages');
    }
    //Funcion para ver los contactos de un usuario
    public function viewContacts(User $user)
    {
        return $user->role->slug === "customer"
        ? Response::allow()
        : Response::deny('You are not allowed to see this contacts');
    }
}
