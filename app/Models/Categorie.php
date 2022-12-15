<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    //Relacion uno a muchos
    // Un electrodomestico le pertenece a una categoria
    public function products(){
        return $this->hasMany(Product::class);
    }
    // Relación polimórfica uno a uno
    // Una categoria puede tener una imagen
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}
