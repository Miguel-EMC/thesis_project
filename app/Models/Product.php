<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price_min',
        'price_max',
        'detail',
        'stock',
        'state_appliance',
        'delivery_method',
        'brand',
    ];

    // Relación de uno a muchos
    // Un electrodomestico le pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación de uno a muchos
    // Un electrodomestico le pertenece a una categoria
    public function categories()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Relación polimórfica uno a uno
    // Un reporte pueden tener una imagen
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}
