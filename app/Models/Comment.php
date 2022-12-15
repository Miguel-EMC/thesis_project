<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
    ];

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
