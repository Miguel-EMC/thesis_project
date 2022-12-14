<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path'];
    
    use HasFactory;

    // Relación polimórfica uno a uno
    // Una imagen le pertenece a un usuario y electrodomestico.
    public function imageable()
    {
        return $this->morphTo();
    }
}
