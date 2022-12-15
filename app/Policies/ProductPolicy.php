<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    use HandlesAuthorization;


    public function update(User $user, Product $product){
        return $user->id === $product->user_id
         ? Response::allow()
         : Response::deny('You do not own this product.');
    }
}
