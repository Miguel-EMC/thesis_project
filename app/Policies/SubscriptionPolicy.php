<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Response;

class SubscriptionPolicy
{
    use HandlesAuthorization;
    public function create(User $user){
        return $user->role->slug === "customer"
            ? Response::allow()
            : Response::deny('You are not allowed to subscribe products.');
    }
}
