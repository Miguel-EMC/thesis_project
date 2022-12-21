<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ReportPolicy
{
    use HandlesAuthorization;

    //Funcion para ver el reporte de un producto de un usuario en especifico

    public function viewAny(User $user)
    {
        return $user->role->slug === "admin"
            ? Response::allow()
            : Response::deny('You are not allowed to view reports.');
    }

    public function view(User $user)
    {
        return $user->role->slug === 'admin'
            ? Response::allow()
            : Response::deny('You are not allowed to view reports.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role->slug === 'customer'
            ? Response::allow()
            : Response::deny('You are not allowed to create reports.');
    }


    public function update(User $user, Report $report)
    {
        //
    }

    //Funcion para eliminar un reporte de un producto de un usuario en especifico
    public function delete(User $user, Report $report)
    {
        return $user->id === $report->user_id && $user->role->slug === 'customer'
            ? Response::allow()
            : Response::deny('You are not allowed to delete this report.');
    }

    public function restore(User $user, Report $report)
    {
        
    }

    public function forceDelete(User $user, Report $report)
    {
        
    }
}
