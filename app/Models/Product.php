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
}
