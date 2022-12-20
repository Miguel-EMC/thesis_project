<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($comment) {
            $comment->user_id = Auth::id();
        });
    }

    // Relación polimórfica uno a muchos
    // un usuario puede tener muchos comentarios
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
