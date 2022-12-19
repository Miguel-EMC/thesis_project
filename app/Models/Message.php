<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($message) {
            $message->user_id = Auth::id();
        });
    }
    //Relación
    //un mensaje pertenece a un user y un user puede tener muchos mensajes
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relación
    //un mensaje pertenece a un producto y un producto puede tener muchos mensajes
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
