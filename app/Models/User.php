<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasImage ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'personal_phone',
        'home_phone',
        'address',
        'email',
        'password',
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Relación de uno a muchos
    // Un usuario puede realizar muchas ventas de electrodomesticos
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Categorie::class)->withTimestamps();
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
}