<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    use HandlesAuthorization;

    //Funcion para crear un producto si el usuario tiene el rol de customer
    public function create(User $user){
        return $user->role->slug  === 'customer'
         ? Response::allow()
         : Response::deny('You are not allowed to create products.');
    }

    //Funcion para verificar si el usuario es el dueño del producto
    public function update(User $user, Product $product){
        return $user->id === $product->user_id
         ? Response::allow()
         : Response::deny('You do not own this product.');
    }

    //Funcion para eliminar un producto si el usuario es el dueño del producto
    public function delete(User $user, Product $product){
        return $user->id === $product->user_id
         ? Response::allow()
         : Response::deny('You do not own this product.');
    }
}
