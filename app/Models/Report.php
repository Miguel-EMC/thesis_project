<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

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
