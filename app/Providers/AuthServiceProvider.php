<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Message;
use App\Models\Product;
use App\Models\Report;
use App\Models\Subscription;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\MessagePolicy;
use App\Policies\ProductPolicy;
use App\Policies\ReportPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Product::class => ProductPolicy::class,
        Comment::class => CommentPolicy::class,
        Report::class => ReportPolicy::class,
        Message::class => MessagePolicy::class,
        Subscription::class => SubscriptionPolicy::class,
    ];


    public function boot()
    {
        $this->registerPolicies();

        // Gestion de productos por parte del usuario con rol customer
        Gate::define('manage-product',function (User $user){
            return $user->role->slug === "customer";
        });

        // El perfil de usuario cusomer puede realizar comentarios
        Gate::define('create-comment',function (User $user){
            return $user->role->slug === "customer";
        });

        // El perfil de usario customer puede realizar reportes
        Gate::define('create-report',function (User $user){
            return $user->role->slug === "customer";
        });

        // El perfil de usuario customer puede enviar mensajes
        Gate::define('create-message',function (User $user){
            return $user->role->slug === "customer";
        });

        // El perfil de usuario customer puede realizar suscripciones
        Gate::define('create-subscription',function (User $user){
            return $user->role->slug === "customer";
        });
    }
}
