<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'price',
        'detail',
        'stock',
        'state_appliance',
        'state',
        'delivery_method',
        'brand',
        'address',
        'phone',
        'categorie_id',
        'image',
        'featured',
        'created_at',
        'updated_at',
    ];

    //Funcion para obtener el usuario que creo el producto
    public static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->user_id = Auth::id();
        });
    }


    //Relacion uno a muchos
    // Un electrodomestico le pertenece a una categoria
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Relación uno a muchos
    // Un electrodomestico puede tener muchos comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relación uno a muchos
    // Un electrodomestico puede tener muchos reportes
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Relación uno a muchos
    // Un electrodomestico puede tener muchos usuarios
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // Relación uno a muchos
    // Un electrodomestico puede tener muchos mensajes
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
