<?php

namespace App\Providers;

use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        ProductPolicy::class => ProductPolicy::class,
    ];

    
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-product', function ($user, $product) {
            return $user->id === $product->user_id;
        });
    }
}
