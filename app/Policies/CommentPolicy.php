<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    use HandlesAuthorization;

    //Funcion para ver comentarios si el usuario tiene el rol de customer
    public function viewAny(User $user)
    {
        return $user->role->slug === "customer";
    }

    // Funcion para ver un comentario si el usuario tiene el rol de customer
    public function view(User $user)
    {
        return $user->role->slug === "customer";
    }

    //Funcion para crear un comentario si el usuario tiene el rol de customer
    public function create(User $user){
        return $user->role->slug  === 'customer'
         ? Response::allow()
         : Response::deny('You are not allowed to create comments.');
    }

    //Funcion para verificar si el usuario es el dueño del comentario
    public function update(User $user, Comment $comment){
        return $user->id === $comment->user_id
         ? Response::allow()
         : Response::deny('You do not own this comment.');
    }

    //Funcion para eliminar un comentario si el usuario es el dueño del comentario
    public function delete(User $user, Comment $comment){
        return $user->id === $comment->user_id
         ? Response::allow()
         : Response::deny('You do not own this comment.');
    }

    public function restore(User $user, Comment $comment)
    {
        //
    }

    public function forceDelete(User $user, Comment $comment)
    {
        //
    }
}
