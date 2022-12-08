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

    // Relación de uno a muchos
    // Un electrodomestico le pertenece a una categoria
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Relación de muchos a muchos
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
