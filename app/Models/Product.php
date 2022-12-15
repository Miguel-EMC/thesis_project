<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

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
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}
