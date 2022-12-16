<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    // Funcion para obtener el usuario que creo el reporte
    public static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->user_id = Auth::id();
        });
    }

    // Relación polimórfica uno a muchos
    // Un reporte puede tener muchos usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación polimórfica uno a muchos
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
