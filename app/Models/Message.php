<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;
    protected $fillable =[
        'from',
        'to',
        'message'];

        // //Funcion para obtener el usuario que envio el mensaje
    public static function boot()
    {
        parent::boot();
        static::creating(function ($comment) {
             $comment->from= Auth::id();
        });
    }

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }

}
