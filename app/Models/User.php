<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomResetPassword;
use App\Traits\HasImage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasImage;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email', 'username', 'first_name', 'last_name', 'personal_phone', 'home_phone',
        'address', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
    // Relación de uno a muchos
    // Un usuario le pertenece un rol
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    // Obtener el nombre completo del usuario
    public function getFullName()
    {
        return "$this->first_name $this->last_name";
    }

    // Crear un avatar por default
    public function getDefaultAvatarPath()
    {
        return "https://cdn-icons-png.flaticon.com/512/711/711769.png";
    }
    // Obtener la imagen de la BDD
    public function getAvatarPath()
    {
        // se verifica no si existe una iamgen
        if (!$this->image) {
            // asignarle el path de una imagen por defecto
            return $this->getDefaultAvatarPath();
        }
        // retornar el path de la imagen registrada en la BDD
        return $this->image->path;
    }

    // Relación uno a muchos
    // Un usuario puede tener muchos comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relación uno a muchos
    // Un usuario puede tener muchos reportes
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    // Relación uno a muchos
    // Un usuario puede tener muchos electrodomesticos
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    // Función para saber si el rol que tiene asignado el usuario
    // es el mismo que se le esta pasando a la función
    public function hasRole(string $role_slug)
    {
        return $this->role->slug === $role_slug;
    }

    // Relación uno a muchos
    // Un usuario puede tener muchos mensajes
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Relación uno a muchos
    // Un usuario puede tener muchas suscripciones
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
