<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Product::class => ProductPolicy::class,
    ];

    
    public function boot()
    {
        $this->registerPolicies();

        // Gestion de productos por parte del usuario con rol customer
        Gate::define('manage-product',function (User $user){
            return $user->role->slug === "customer";
        });
    }
}
