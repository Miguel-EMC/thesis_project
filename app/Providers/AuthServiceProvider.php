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
use Illuminate\Auth\Notifications\ResetPassword;
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

        //   :: Creacion de permisos para el rol Customer ::

        // Gestion de productos por parte del usuario con rol customer
        Gate::define('manage-product', function (User $user) {
            return $user->role->slug === "customer";
        });

        // El perfil de usuario cusomer puede realizar comentarios
        Gate::define('create-comment', function (User $user) {
            return $user->role->slug === "customer";
        });

        // El perfil de usario customer puede realizar reportes
        Gate::define('create-report', function (User $user) {
            return $user->role->slug === "customer";
        });

        // El perfil de usuario customer puede enviar mensajes
        Gate::define('create-message', function (User $user) {
            return $user->role->slug === "customer";
        });

        // El perfil de usuario customer puede realizar suscripciones
        Gate::define('create-subscription', function (User $user) {
            return $user->role->slug === "customer";
        });

        // El perfil de usuario customer puede visualizar las categorias de productos
        Gate::define('view-category', function (User $user) {
            return $user->role->slug === "customer";
        });

        //   :: Creacion de permisos para el rol Admin ::

        // El perfil de usuario admin puede gestionar categorias
        Gate::define('manage-category', function (User $user) {
            return $user->role->slug === "admin";
        });

        // El perfil de usuario admin puede gestionar clientes
        Gate::define('manage-customer', function (User $user) {
            return $user->role->slug === "admin";
        });

        // El perfil de usuario admin puede visualizar todos los comentarios
        Gate::define('view-comment', function (User $user) {
            return $user->role->slug === "admin";
        });

        // El perfil de usuario admin puede gestionar reportes
        Gate::define('manage-report', function (User $user) {
            return $user->role->slug === "admin";
        });

        // El perfil de usuario admin puede visualizar todos los productos
        Gate::define('view-product', function (User $user) {
            return $user->role->slug === "admin";
        });

        // El perfil de usuario admin puede gestionar suscripciones
        Gate::define('manage-subscription', function (User $user) {
            return $user->role->slug === "admin";
        });

        // ResetPassword::createUrlUsing(function ($user, string $token) {
        //     return  'http://localhost:3000/login/resetpssw/?='.$token;
        // });
    }
}
