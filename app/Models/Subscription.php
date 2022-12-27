<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'payment_method',
        'start_date',
        'end_date',
        'price',
        'user_id',
        'product_id',
    ];

    //Relación uno a muchos inversa
    //un producto puede tener muchas suscripciones
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    //Relación uno a muchos inversa
    //un usuario puede tener muchas suscripciones a productos
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
