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
        'categorie_id',
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
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    // Relación uno a muchos
    // Un electrodomestico puede tener muchos comentarios
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    // Relación uno a muchos
    // Un electrodomestico puede tener muchos reportes
    public function reports(){
        return $this->hasMany(Report::class);
    }

    // Relación uno a muchos
    // Un electrodomestico puede tener muchos usuarios
    public function users(){
        return $this->belongsToMany(User::class);
    }
    
    // Relación polimórfica uno a uno
    // Un electrodomestico puede tener una imagen
    public function getDefaultImagenProductPath(){
        // retornar el path de la imagen por defecto
        return "https://cdn-icons-png.flaticon.com/512/1261/1261106.png";
    }

    // Obtener la imagen de la BDD
    public function getProdcutPath(){
        // se verifica no si existe una iamgen
        if(!$this->image){
            // asignarle el path de una imagen por defecto
            return $this->getDefaultImagenProductPath();
        }
        // retornar el path de la imagen registrada en la BDD
        return $this->image->path;
    }
    // Relación uno a muchos
    // Un electrodomestico puede tener muchos mensajes
    public function messages(){
        return $this->hasMany(Message::class);
    }
}
