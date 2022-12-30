<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoriePolicy
{
    use HandlesAuthorization;

   // Funcion para mostrar todas las categorias registradas en la base de datos para el administrador y el usuario
    public function index(User $user)
    {
        return $user->role->slug  === 'admin' || $user->role->slug  === 'customer'
         ? Response::allow()
         : Response::deny('You are not allowed to create products.');
    }

    //Funcion para mostrar una categoria en especifico para el administrador y el usuario
    public function show(User $user)
    {
        return $user->role->slug  === 'admin' || $user->role->slug  === 'customer'
         ? Response::allow()
         : Response::deny('You are not allowed to create products.');
    }

    //Funcion para crear una categoria en la base de datos para el administrador
    public function store(User $user)
    {
        return $user->role->slug  === 'admin'
         ? Response::allow()
         : Response::deny('You are not allowed to create products.');
    }

    //Funcion para actualizar una categoria en la base de datos para el administrador
    public function update(User $user){
        return $user->role->slug  === 'admin'
         ? Response::allow()
         : Response::deny('You are not allowed to create products.');
    }

    //Funcion para eliminar una categoria en la base de datos para el administrador
    public function delete(User $user){
        return $user->role->slug  === 'admin'
         ? Response::allow()
         : Response::deny('You are not allowed to create products.');
    }
}
