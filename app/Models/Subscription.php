<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public static function boot()
    {
        parent::boot();
        static::creating(function ($subscription) {
            $subscription->user_id = Auth::id();
        });
    }

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
